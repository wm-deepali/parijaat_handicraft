<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\State;
use App\Support\Region;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\InvoiceSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CustomerAddress;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concerns\InvoiceHelpers;

class UserDashboardController extends Controller
{
    use InvoiceHelpers;

    public function index(Request $request)
    {
        $customer = auth('customer')->user();
        $country = app(Region::class)->current();

        $addresses = $customer->addresses()->with(['state', 'city'])
            ->orderByDesc('is_default')->latest()->get();

        $states = State::when($country, fn($q) => $q->where('country_id', $country->id))
            ->orderBy('name')->get();

        $currencies = Currency::get()->keyBy('code');

        // ── Dashboard stats (one grouped query) ──
        $byStatus = Order::where('customer_id', $customer->id)
            ->selectRaw('status, COUNT(*) as c')
            ->groupBy('status')
            ->pluck('c', 'status');

        $ordersTotal = (int) $byStatus->sum();

        $stats = [
            'total' => $ordersTotal,
            'active' => (int) collect(['new', 'pending', 'processing', 'shipped'])->sum(fn($s) => $byStatus[$s] ?? 0),
            'delivered' => (int) ($byStatus['delivered'] ?? 0),
            'cancelled' => (int) ($byStatus['cancelled'] ?? 0),
        ];

        // ── Dashboard tab: 3 recent orders ──
        $recent = Order::where('customer_id', $customer->id)
            ->with($this->orderRelations())
            ->latest()->take(3)->get()
            ->map(fn($o) => $this->presentOrder($o, $currencies));

        // ── My Orders tab ──
        $search = trim((string) $request->input('q'));

        $orders = Order::where('customer_id', $customer->id)
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('order_number', 'like', "%{$search}%")
                        ->orWhereHas('items', fn($i) => $i->where('product_name', 'like', "%{$search}%"));
                });
            })
            ->with($this->orderRelations())
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->fragment('tab-3');

        $orders->getCollection()->transform(fn($o) => $this->presentOrder($o, $currencies));

        // ── Track Order tab ──
        $trackNo = ltrim(trim((string) $request->input('track')), '#');
        $trackNotFound = false;
        $tracked = null;

        $trackBase = Order::where('customer_id', $customer->id)->with($this->orderRelations());

        if ($trackNo !== '') {
            $found = (clone $trackBase)->where('order_number', $trackNo)->first();
            $found ? $tracked = $this->presentOrder($found, $currencies) : $trackNotFound = true;
        } else {
            $found = (clone $trackBase)->whereIn('status', ['new', 'pending', 'processing', 'shipped'])->latest()->first()
                ?? (clone $trackBase)->latest()->first();

            if ($found) {
                $tracked = $this->presentOrder($found, $currencies);
            }
        }

        // ── Wishlist tab ──
        $wishlist = $this->wishlistItems($customer->id);
        $wishCount = $wishlist->count();

        return view('front-pages.dashboard', compact(
            'customer',
            'addresses',
            'states',
            'country',
            'orders',
            'ordersTotal',
            'stats',
            'recent',
            'tracked',
            'trackNotFound',
            'trackNo',
            'wishlist',
            'wishCount'
        ));
    }

    private function orderRelations(): array
    {
        return [
            'items.product',
            'items.imageVariant',
            'items.addons',
            'courier',
            'state',
            'city',
            'country',
            'invoice',
            'latestPayment',
            'statusHistory',
            'refundTransactions',
        ];
    }

    /**
     * Everything the order cards / track panel need, already formatted.
     * Amounts are stored in the default currency; they are shown in the currency the customer paid in.
     */
    private function presentOrder(Order $o, $currencies): array
    {
        // ── currency / money formatter ──
        $defCode = $o->default_currency_code ?: app(Region::class)->default()?->currency_code;
        $hasSnap = $o->currency_code && $o->total_customer !== null;
        $cur = $currencies[$o->currency_code ?: $defCode] ?? null;
        $symbol = $cur ? ($cur->symbol ?: $cur->code) : app(Region::class)->defaultSymbol();
        $space = ctype_alpha(str_replace(' ', '', $symbol)) ? ' ' : '';
        $decimals = (int) ($cur->decimals ?? 2);

        // default currency -> customer currency (fx + country extra %), same ratio the order was frozen with
        $factor = ($hasSnap && (float) $o->total_default > 0)
            ? (float) $o->total_customer / (float) $o->total_default
            : 1.0;

        $money = fn($v) => $symbol . $space . number_format((float) $v * $factor, $decimals);
        $total = $hasSnap
            ? $symbol . $space . number_format((float) $o->total_customer, $decimals)
            : $money($o->grand_total);

        // ── status badge ──
        $statusMap = [
            'new' => ['Placed', 'pending'],
            'pending' => ['Pending', 'pending'],
            'processing' => ['Processing', 'processing'],
            'shipped' => ['Shipped', 'shipped'],
            'delivered' => ['Delivered', 'delivered'],
            'cancelled' => ['Cancelled', 'cancelled'],
        ];
        [$statusLabel, $statusClass] = $statusMap[$o->status] ?? [ucfirst($o->status), 'processing'];

        // ── items ──
        $items = $o->items->map(function ($i) use ($money) {
            $thumb = null;
            if ($i->imageVariant && $i->imageVariant->image) {
                $thumb = asset('storage/' . $i->imageVariant->image);
            } elseif ($i->product) {
                $thumb = $i->product->display_image;
            }

            $variant = null;
            if (!empty($i->selected_attributes)) {
                $variant = collect($i->selected_attributes)->map(function ($value, $key) {
                    if (is_array($value)) {
                        $name = $value['attribute'] ?? $value['name'] ?? $key;
                        $val = $value['value'] ?? $value['label'] ?? reset($value);
                        return $name . ': ' . $val;
                    }
                    return $key . ': ' . $value;
                })->join(' · ');
            }

            $addonsTotal = $i->addons->sum('price');

            return [
                'name' => $i->product_name ?? ($i->product->name ?? 'Product'),
                'thumb' => $thumb,
                'variant' => $variant,
                'qty' => $i->quantity,
                'addons' => $i->addons->map(fn($a) => $a->detail . ' (' . $money($a->price) . ')')->all(),
                'line' => $money(($i->price * $i->quantity) + $addonsTotal),
            ];
        })->all();

        // ── price details ──
        $prices = [['label' => 'Subtotal', 'value' => $money($o->subtotal), 'green' => false, 'total' => false]];

        if ($o->discount > 0) {
            $prices[] = [
                'label' => 'Discount' . ($o->coupon_code ? " ({$o->coupon_code})" : ''),
                'value' => '− ' . $money($o->discount),
                'green' => true,
                'total' => false,
            ];
        }

        $prices[] = [
            'label' => 'Shipping',
            'value' => $o->shipping_charge > 0 ? $money($o->shipping_charge) : 'Free',
            'green' => $o->shipping_charge <= 0,
            'total' => false,
        ];

        if ($o->tax_amount > 0) {
            $prices[] = [
                'label' => $o->tax_handling === 'destination_vat' ? 'VAT' : 'Tax (GST)',
                'value' => $money($o->tax_amount),
                'green' => false,
                'total' => false,
            ];
        }

        $prices[] = [
            'label' => $o->payment_status === 'paid' ? 'Total paid' : 'Total',
            'value' => $total,
            'green' => false,
            'total' => true,
        ];

        // ── refund (cancelled + paid only) ──
        $refund = null;
        if ($o->status === 'cancelled' && in_array($o->payment_status, ['paid', 'refunded'])) {
            $done = $o->refundTransactions->where('status', 'completed')->first();
            $refund = [
                'amount' => $done ? $money($done->amount) : $total,
                'status' => $done ? 'Refund completed' : 'Refund pending',
            ];
        }

        // ── timeline ──
        $labels = [
            'new' => ['Order Placed', 'We have received your order.'],
            'pending' => ['Order Placed', 'We have received your order.'],
            'processing' => ['Order Confirmed', 'Your order is being prepared.'],
            'shipped' => ['Shipped', 'Your package has been dispatched.'],
            'delivered' => ['Delivered', 'Package delivered to you.'],
            'cancelled' => ['Order Cancelled', 'This order was cancelled.'],
        ];

        // skip COD-payment log rows (previous_status === status)
        $history = $o->statusHistory
            ->sortBy('created_at')
            ->filter(fn($h) => $h->previous_status !== $h->status)
            ->values();

        $timeline = [];
        if ($history->isEmpty() || !in_array($history->first()->status, ['new', 'pending'])) {
            $timeline[] = ['status' => 'new', 'time' => $o->created_at];
        }
        foreach ($history as $h) {
            $timeline[] = ['status' => $h->status, 'time' => $h->created_at];
        }

        $isTerminal = in_array($o->status, ['delivered', 'cancelled']);
        $lastIdx = count($timeline) - 1;

        $steps = [];
        foreach ($timeline as $idx => $t) {
            [$title, $desc] = $labels[$t['status']] ?? [ucfirst($t['status']), ''];

            if ($t['status'] === 'cancelled') {
                $class = 'cancel';
            } elseif ($idx === $lastIdx && !$isTerminal) {
                $class = 'current';
            } else {
                $class = 'done';
            }

            $steps[] = [
                'class' => $class,
                'title' => $title,
                'desc' => $desc,
                'time' => $t['time']->format('d M, h:i A'),
            ];
        }

        // upcoming steps for an order still in progress
        $flow = ['processing', 'shipped', 'delivered'];
        $curIdx = array_search($o->status, $flow);
        if (!$isTerminal && $curIdx !== false) {
            foreach (array_slice($flow, $curIdx + 1) as $next) {
                $steps[] = ['class' => '', 'title' => $labels[$next][0], 'desc' => '', 'time' => null];
            }
        } elseif (!$isTerminal && in_array($o->status, ['new', 'pending'])) {
            foreach ($flow as $next) {
                $steps[] = ['class' => '', 'title' => $labels[$next][0], 'desc' => '', 'time' => null];
            }
        }

        // ── 4-stage progress bar for the Track tab (null for cancelled etc.) ──
        $stageDefs = ['new' => 'Order Placed', 'processing' => 'Confirmed', 'shipped' => 'Shipped', 'delivered' => 'Delivered'];
        $stageKeys = array_keys($stageDefs);
        $normal = in_array($o->status, ['new', 'pending']) ? 'new' : $o->status;
        $curStage = array_search($normal, $stageKeys);
        $stages = null;

        if ($curStage !== false) {
            $times = [];
            foreach ($history as $h) {
                $k = in_array($h->status, ['new', 'pending']) ? 'new' : $h->status;
                $times[$k] ??= $h->created_at;
            }
            $times['new'] ??= $o->created_at;

            $stages = [];
            foreach ($stageKeys as $idx => $k) {
                $class = $idx < $curStage
                    ? 'done'
                    : ($idx === $curStage ? ($k === 'delivered' ? 'done' : 'current') : '');

                $stages[] = [
                    'key' => $k,
                    'title' => $stageDefs[$k],
                    'class' => $class,
                    'time' => ($idx <= $curStage && isset($times[$k])) ? $times[$k]->format('d M, h:i A') : null,
                ];
            }
        }

        // ── payment / shipment boxes ──
        $payMethod = ucfirst(str_replace('_', ' ', $o->payment_method ?? '—'));
        $txn = $o->transaction_id ?: $o->razorpay_payment_id;

        return [
            'id' => $o->id,
            'number' => $o->order_number,
            'placed' => $o->created_at->format('d M Y'),
            'total' => $total,
            'status' => $o->status,
            'status_label' => $statusLabel,
            'status_class' => $statusClass,
            'is_active' => !$isTerminal,

            'items' => $items,
            'items_count' => count($items),
            'prices' => $prices,
            'refund' => $refund,
            'steps' => $steps,
            'stages' => $stages,

            'address' => [
                'name' => $o->customer_name,
                'line1' => $o->address_line_1,
                'line2' => $o->address_line_2,
                'city' => $o->city?->name,
                'state' => $o->state?->name,
                'pin' => $o->pincode,
                'country' => $o->country?->name ?? 'India',
                'phone' => $o->customer_phone,
            ],
            'payment' => [
                'method' => $payMethod,
                'status' => ucfirst($o->payment_status),
                'txn' => $txn,
                'paid_via' => $o->latestPayment?->method_label,
            ],
            'shipment' => ($o->courier || $o->tracking_number) ? [
                'courier' => $o->courier?->name,
                'tracking' => $o->tracking_number,
                'site' => $o->courier?->website_url,
            ] : null,

            // opens this order in the dashboard's Track Order tab
            'track_url' => url()->current() . '?track=' . urlencode($o->order_number) . '#tab-2',
            'has_invoice' => (bool) $o->invoice,
            'invoice_url' => ($o->invoice && Route::has('user.orders.invoice'))
                ? route('user.orders.invoice', $o->id)
                : null,
        ];
    }

    // ── Customer invoice: browser view ──
    public function invoice($id)
    {
        $order = $this->invoiceOrder($id);

        if (!$order->invoice) {
            return back()->with('error', 'Invoice is not available for this order yet.');
        }

        return view('admin.orders.invoice', $this->invoiceViewData($order));
    }

    // ── Customer invoice: PDF download ──
    public function invoiceDownload($id)
    {
        $order = $this->invoiceOrder($id);

        if (!$order->invoice) {
            return back()->with('error', 'Invoice is not available for this order yet.');
        }

        $pdf = Pdf::loadView('admin.orders.invoice', $this->invoiceViewData($order) + ['isPdf' => true])
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'dpi' => 150,
            ]);

        return $pdf->download('Invoice-' . $order->invoice->invoice_number . '.pdf');
    }

    // Only the logged-in customer's own order, otherwise 404
    private function invoiceOrder($id): Order
    {
        return Order::where('customer_id', auth('customer')->id())
            ->with(['items.product', 'items.addons', 'state', 'city', 'latestPayment', 'invoice'])
            ->findOrFail($id);
    }

    private function invoiceViewData(Order $order): array
    {
        $setting = InvoiceSetting::with(['state', 'city'])->first();

        $logo_64 = null;
        if ($setting?->company_logo) {
            $logoPath = storage_path('app/public/' . $setting->company_logo);
            if (file_exists($logoPath)) {
                $logo_64 = 'data:' . mime_content_type($logoPath) . ';base64,'
                    . base64_encode(file_get_contents($logoPath));
            }
        }

        $currencies = Currency::get()->keyBy('code');

        return [
            'order' => $order,
            'invoice' => $order->invoice,
            'setting' => $setting,
            'logo_64' => $logo_64,
            'sym' => $this->orderSymbol($order, $currencies),
            'regionInfo' => $this->regionInfo($order, $currencies),
            'isExport' => $order->gst_type === 'export' || $order->tax_handling === 'export',
            'customerView' => true,
        ];
    }

    public function updateProfile(Request $request)
    {
        $customer = auth('customer')->user();

        $v = $request->validate([
            'name' => ['required', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'mobile' => ['required', 'regex:/^\d{6,14}$/', Rule::unique('customers', 'mobile')->ignore($customer->id)],
            'dob' => ['nullable', 'date', 'before:today'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'name.regex' => 'Name should contain only letters.',
            'mobile.regex' => 'Enter a valid mobile number.',
        ]);

        $data = [
            'name' => $v['name'],
            'mobile' => $v['mobile'],
            'dob' => $v['dob'] ?? null,
        ];

        if ($request->hasFile('photo')) {
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }
            $data['avatar'] = $request->file('photo')->store('avatars', 'public');
        }

        $customer->update($data);

        return response()->json(['success' => true]);
    }

    private function rules(Request $request): array
    {
        $country = app(Region::class)->current();
        $isIndia = !$country || $country->iso2 === 'IN';

        return [
            'name' => 'required|string|max:255',
            'phone' => ['required', $isIndia ? 'regex:/^[6-9]\d{9}$/' : 'regex:/^[0-9+\-\s()]{6,20}$/'],
            'pincode' => ['required', $isIndia ? 'regex:/^\d{6}$/' : 'regex:/^[A-Za-z0-9\- ]{3,12}$/'],
            'state_id' => ['required', Rule::exists('states', 'id')->when($country, fn($r) => $r->where('country_id', $country->id))],
            'city_id' => ['required', Rule::exists('cities', 'id')->where('state_id', $request->state_id)],
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'address_type' => 'nullable|in:home,office,other',
            'is_default' => 'nullable|boolean',
        ];
    }

    public function storeAddress(Request $request)
    {
        $customer = auth('customer')->user();
        $v = $request->validate($this->rules($request));

        DB::transaction(function () use ($customer, $v) {
            $makeDefault = !empty($v['is_default']) || !$customer->addresses()->exists();

            if ($makeDefault) {
                CustomerAddress::where('customer_id', $customer->id)->update(['is_default' => 0]);
            }

            CustomerAddress::create([
                'customer_id' => $customer->id,
                'name' => $v['name'],
                'email' => $customer->email,
                'phone' => $v['phone'],
                'address_line_1' => $v['address_line_1'],
                'address_line_2' => $v['address_line_2'] ?? null,
                'country' => app(Region::class)->current()?->name ?? 'India',
                'state_id' => $v['state_id'],
                'city_id' => $v['city_id'],
                'pincode' => $v['pincode'],
                'address_type' => $v['address_type'] ?? 'home',
                'is_default' => $makeDefault ? 1 : 0,
            ]);
        });

        return response()->json(['success' => true]);
    }

    public function updateAddress(Request $request, $id)
    {
        $customer = auth('customer')->user();
        $address = CustomerAddress::where('customer_id', $customer->id)->findOrFail($id);
        $v = $request->validate($this->rules($request));

        DB::transaction(function () use ($customer, $address, $v) {
            $address->update([
                'name' => $v['name'],
                'phone' => $v['phone'],
                'address_line_1' => $v['address_line_1'],
                'address_line_2' => $v['address_line_2'] ?? null,
                'state_id' => $v['state_id'],
                'city_id' => $v['city_id'],
                'pincode' => $v['pincode'],
                'address_type' => $v['address_type'] ?? 'home',
            ]);

            if (!empty($v['is_default'])) {
                CustomerAddress::where('customer_id', $customer->id)->update(['is_default' => 0]);
                $address->update(['is_default' => 1]);
            }
        });

        return response()->json(['success' => true]);
    }

    public function destroyAddress($id)
    {
        $customer = auth('customer')->user();
        $address = CustomerAddress::where('customer_id', $customer->id)->findOrFail($id);
        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault) {
            $customer->addresses()->latest()->first()?->update(['is_default' => 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Wishlist cards for the dashboard: same card data as the listing pages,
     * plus category, stock and "you save" amount. Hidden/deleted products are skipped.
     */
    private function wishlistItems(int $customerId)
    {
        $ids = Wishlist::where('customer_id', $customerId)->latest('id')->pluck('product_id')->all();

        if (!$ids) {
            return collect();
        }

        $cards = Product::visible()->forCard()->whereIn('id', $ids)->get()->keyBy('id');

        $extra = Product::whereIn('id', $ids)
            ->with('category:id,name')
            ->get(['id', 'category_id', 'price', 'mrp', 'stock'])
            ->keyBy('id');

        $region = app(Region::class);

        return collect($ids)
            ->filter(fn($id) => $cards->has($id))
            ->map(function ($id) use ($cards, $extra, $region) {
                $card = $cards[$id]->toCard();
                $x = $extra[$id] ?? null;

                $img = $card['img'] ?? null;
                if ($img && !\Illuminate\Support\Str::startsWith($img, ['http://', 'https://', '//'])) {
                    $img = asset($img);
                }

                $card['img'] = $img;
                $card['category'] = $x?->category?->name;
                $card['in_stock'] = $x ? $x->stock > 0 : true;
                $card['save'] = ($x && $x->mrp > $x->price) ? $region->format($x->mrp - $x->price) : null;

                return $card;
            })
            ->values();
    }

    // ── Wishlist: remove (AJAX) ──
    public function removeWishlist($id)
    {
        Wishlist::where('customer_id', auth('customer')->id())
            ->where('product_id', $id)
            ->delete();

        return response()->json(['success' => true]);
    }

}