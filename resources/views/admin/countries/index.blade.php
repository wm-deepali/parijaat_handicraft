@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        .cc-page { background:#f1f2f4; padding:24px 28px; min-height:100vh; font-family:'Inter',system-ui,sans-serif; color:#202223; }
        .cc-page * { box-sizing:border-box; }
        .cc-page h1 { font-size:20px; margin:0 0 4px; font-weight:650; }
        .cc-sub { font-size:12.5px; color:#6d7175; margin-bottom:16px; }
        .cc-card { background:#fff; border:1px solid #e3e5e8; border-radius:12px; margin-bottom:16px; overflow:hidden; }
        .cc-head { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; padding:14px 20px; background:#fafafa; border-bottom:1px solid #e3e5e8; }
        .cc-head h5 { margin:0; font-size:13px; font-weight:650; }
        .cc-tools { display:flex; gap:12px; align-items:center; flex-wrap:wrap; font-size:12.5px; }
        .cc-tools input[type=text] { height:34px; border:1px solid #e3e5e8; border-radius:8px; padding:0 10px; width:220px; }
        .cc-scroll { overflow-x:auto; max-height:640px; overflow-y:auto; }
        .cc-table { width:100%; border-collapse:collapse; font-size:13px; }
        .cc-table th { position:sticky; top:0; background:#fafafa; text-align:left; font-size:11px; letter-spacing:.05em; text-transform:uppercase; color:#8c9196; padding:10px 12px; border-bottom:1px solid #e3e5e8; white-space:nowrap; }
        .cc-table td { padding:8px 12px; border-bottom:1px solid #f0f1f3; vertical-align:middle; }
        .cc-table tr.is-off td { opacity:.6; }
        .cc-table input[type=number], .cc-table input[type=text], .cc-table select { height:34px; border:1px solid #e3e5e8; border-radius:8px; padding:0 8px; font-size:13px; }
        .cc-table input[type=number] { width:90px; }
        .cc-table .sym { width:64px; }
        .cc-table .rate { width:150px !important; }
        .cc-badge { font-size:10.5px; font-weight:650; padding:2px 8px; border-radius:20px; background:#f0f1fc; color:#303d89; }
        .cc-badge.man { background:#fff5cc; color:#916a00; }
        .cc-note { font-size:11.5px; color:#8c9196; padding:10px 20px; border-top:1px solid #e3e5e8; background:#fafafa; }
        .cc-bar { background:#fff; border:1px solid #e3e5e8; border-radius:12px; padding:14px 20px; display:flex; justify-content:flex-end; gap:10px; }
        .cc-btn { display:inline-flex; align-items:center; gap:6px; border-radius:8px; padding:9px 18px; font-size:13px; font-weight:600; cursor:pointer; border:1px solid #e3e5e8; background:#fff; color:#202223; }
        .cc-btn.primary { background:#303d89; color:#fff; border-color:#303d89; }
        .cc-alert { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:12px; }
        .cc-alert.ok { background:#e3f1ec; color:#007a5e; }
        .cc-alert.warn { background:#fff5cc; color:#916a00; }
        .cc-alert.err { background:#fce8e8; color:#b22222; }
        .cc-default-pill { background:#e3f1ec; color:#007a5e; font-size:10.5px; font-weight:650; padding:2px 8px; border-radius:20px; margin-left:6px; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cc-page">

            <h1>Countries &amp; Currency</h1>
            <div class="cc-sub">
                Enabled countries appear in the website header and at checkout. Product prices are entered in the
                <b>default currency</b>@if($default) (<b>{{ $default->currency_code }}</b>)@endif.
            </div>

            @if (session('success'))<div class="cc-alert ok">{{ session('success') }}</div>@endif
            @if (session('warning'))<div class="cc-alert warn">{{ session('warning') }}</div>@endif
            @if ($errors->any())
                <div class="cc-alert err">@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            @endif

            {{-- separate form for the "Update rates now" button (forms cannot be nested) --}}
            <form id="ratesForm" method="POST" action="{{ route('admin.countries.rates') }}">@csrf</form>

            <form method="POST" action="{{ route('admin.countries.update') }}" id="ccForm">
                @csrf

                {{-- ═══ Exchange rates ═══ --}}
                <div class="cc-card">
                    <div class="cc-head">
                        <h5>Exchange Rates <small style="font-weight:400;color:#8c9196">(1 USD = ?)</small></h5>
                        <button type="submit" form="ratesForm" class="cc-btn"><i class="fa fa-rotate"></i> Update rates now</button>
                    </div>
                    <div class="cc-scroll" style="max-height:none">
                        <table class="cc-table">
                            <thead><tr><th>Currency</th><th>Symbol</th><th>1 USD =</th><th>Source</th><th>Last updated</th></tr></thead>
                            <tbody>
                            @foreach ($currencies as $cur)
                                <tr>
                                    <td><b>{{ $cur->code }}</b></td>
                                    <td><input type="text" class="sym" maxlength="8" name="currencies[{{ $cur->code }}][symbol]" value="{{ $cur->symbol }}"></td>
                                    <td><input type="number" class="rate" step="0.00000001" min="0" name="currencies[{{ $cur->code }}][usd_rate]"
                                            value="{{ $cur->usd_rate !== null ? rtrim(rtrim(number_format($cur->usd_rate, 6, '.', ''), '0'), '.') : '' }}"
                                            placeholder="not set"></td>
                                    <td><span class="cc-badge {{ $cur->rate_is_manual ? 'man' : '' }}">{{ $cur->rate_is_manual ? 'Manual' : 'Auto' }}</span></td>
                                    <td>{{ $cur->rates_updated_at?->format('d M Y, h:i A') ?? '—' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cc-note">
                        Rates update automatically every night. If you type a rate yourself it is marked <b>Manual</b> and auto-update
                        skips it. Clear the box and save to go back to Auto. The list shows only currencies of enabled countries.
                    </div>
                </div>

                {{-- ═══ Countries ═══ --}}
                <div class="cc-card">
                    <div class="cc-head">
                        <h5>Countries</h5>
                        <div class="cc-tools">
                            <input type="text" id="ccSearch" placeholder="Search country or currency…">
                            <label><input type="checkbox" id="ccOnlyOn"> Show enabled only</label>
                        </div>
                    </div>

                    <div class="cc-scroll">
                        <table class="cc-table" id="ccTable">
                            <thead>
                            <tr>
                                <th>Country</th><th>Currency</th><th>Enabled</th><th>Extra %</th>
                                <th>Tax Handling</th><th>VAT %</th><th>Default</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($countries as $c)
                                <tr class="{{ $c->is_enabled ? '' : 'is-off' }}" data-text="{{ strtolower($c->name . ' ' . $c->currency_code) }}">
                                    <td>{{ $c->name }} @if($c->is_default)<span class="cc-default-pill">Default</span>@endif</td>
                                    <td>{{ $c->currency_code }} <span style="color:#8c9196">({{ $c->currency?->symbol }})</span></td>
                                    <td>
                                        <input type="hidden" name="countries[{{ $c->id }}][is_enabled]" value="0">
                                        <input type="checkbox" class="js-en" name="countries[{{ $c->id }}][is_enabled]" value="1" @checked(old("countries.$c->id.is_enabled", $c->is_enabled))>
                                    </td>
                                    <td><input type="number" step="0.01" min="0" max="500" name="countries[{{ $c->id }}][price_adjustment]"
                                            value="{{ old("countries.$c->id.price_adjustment", $c->price_adjustment + 0) }}"></td>
                                    <td>
                                        <select class="js-tax" name="countries[{{ $c->id }}][tax_handling]">
                                            @foreach (['india_gst' => 'India GST', 'export' => 'Export (no tax)', 'destination_vat' => 'Charge VAT'] as $k => $label)
                                                <option value="{{ $k }}" @selected(old("countries.$c->id.tax_handling", $c->tax_handling) === $k)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" step="0.01" min="0" max="100" class="js-vat" name="countries[{{ $c->id }}][vat_rate]"
                                            value="{{ old("countries.$c->id.vat_rate", $c->vat_rate + 0) }}"></td>
                                    <td><input type="radio" class="js-def" name="default_country" value="{{ $c->id }}" @checked((int) old('default_country', $default?->id) === $c->id)></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cc-note">
                        <b>Extra %</b>: customers of that country see the price this much higher (0 = no change).
                        <b>Tax Handling</b>: "Export (no tax)" for most countries; "Charge VAT" only where your business is VAT-registered.
                        The default country is always enabled.
                    </div>
                </div>

                <div class="cc-bar">
                    <button type="submit" class="cc-btn primary"><i class="fa fa-save"></i> Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var ORIGINAL_DEFAULT = "{{ $default?->id }}";
    var PRODUCT_COUNT = {{ (int) $productCount }};

    function syncRow($tr) {
        $tr.toggleClass('is-off', !$tr.find('.js-en').prop('checked'));
        $tr.find('.js-vat').prop('disabled', $tr.find('.js-tax').val() !== 'destination_vat');
    }

    $('#ccTable tbody tr').each(function () { syncRow($(this)); });

    // default country is always enabled
    $(document).on('change', '.js-def', function () {
        var $tr = $(this).closest('tr');
        $tr.find('.js-en').prop('checked', true);
        syncRow($tr);
    });
    $(document).on('change', '.js-en', function () {
        var $tr = $(this).closest('tr');
        if (!$(this).prop('checked') && $tr.find('.js-def').prop('checked')) {
            alert('The default country cannot be disabled. Choose another default first.');
            $(this).prop('checked', true);
        }
        syncRow($tr);
    });
    $(document).on('change', '.js-tax', function () { syncRow($(this).closest('tr')); });

    // search + enabled-only filter
    function filterRows() {
        var q = $.trim($('#ccSearch').val()).toLowerCase(), only = $('#ccOnlyOn').prop('checked');
        $('#ccTable tbody tr').each(function () {
            var $tr = $(this);
            var show = (!q || $tr.data('text').indexOf(q) !== -1) && (!only || $tr.find('.js-en').prop('checked'));
            $tr.toggle(show);
        });
    }
    $('#ccSearch').on('input', filterRows);
    $('#ccOnlyOn').on('change', filterRows);

    // changing the default currency re-interprets every existing product price
    $('#ccForm').on('submit', function () {
        var now = $('.js-def:checked').val();
        if (PRODUCT_COUNT > 0 && ORIGINAL_DEFAULT && now !== ORIGINAL_DEFAULT) {
            return confirm('You are changing the default country/currency. All ' + PRODUCT_COUNT +
                ' existing product prices were entered in the OLD default currency and will NOT be converted automatically. Continue?');
        }
    });
</script>

@include('admin.footer')