<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BulkEnquiry;
use Illuminate\Http\Request;

class BulkEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $enquiries = BulkEnquiry::query()
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), function ($q) use ($request) {
                $like = '%' . $request->q . '%';
                $q->where(fn($w) => $w->where('full_name', 'like', $like)
                    ->orWhere('company', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('phone', 'like', $like));
            })
            ->latest('id')
            ->paginate(20)
            ->withQueryString();

        $unreadCount = BulkEnquiry::where('is_read', false)->count();

        return view('admin.bulk-enquiries.index', compact('enquiries', 'unreadCount'));
    }

    public function show(BulkEnquiry $bulkEnquiry)
    {
        if (!$bulkEnquiry->is_read) {
            $bulkEnquiry->update(['is_read' => true]);
        }

        return view('admin.bulk-enquiries.show', ['enquiry' => $bulkEnquiry]);
    }

    public function update(Request $request, BulkEnquiry $bulkEnquiry)
    {
        $data = $request->validate([
            'status'     => 'required|in:' . implode(',', array_keys(BulkEnquiry::STATUSES)),
            'admin_note' => 'nullable|string|max:3000',
        ]);

        $bulkEnquiry->update($data);

        return response()->json(['message' => 'Enquiry updated successfully.']);
    }

    public function destroy(BulkEnquiry $bulkEnquiry)
    {
        $bulkEnquiry->delete(); // soft delete

        return response()->json(['message' => 'Enquiry deleted successfully.']);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);

        $count = BulkEnquiry::whereIn('id', $request->ids)->delete();

        return response()->json(['message' => $count . ' enquiries deleted successfully.']);
    }

    /** CSV opens directly in Excel, no extra package needed. */
    public function export()
    {
        $filename = 'bulk-enquiries-' . now()->format('Y-m-d') . '.csv';

        // stops spreadsheet formulas from user-entered text (=, +, -, @)
        $safe = fn($v) => is_string($v) && preg_match('/^[=+\-@]/', $v) ? "'" . $v : $v;

        return response()->streamDownload(function () use ($safe) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // UTF-8 BOM so Excel reads it correctly

            fputcsv($out, ['#', 'Date', 'Name', 'Company', 'Email', 'Phone', 'Category', 'Quantity',
                'Ship To', 'Frequency', 'Status', 'Details']);

            BulkEnquiry::latest('id')->chunk(500, function ($rows) use ($out, $safe) {
                foreach ($rows as $r) {
                    fputcsv($out, array_map($safe, [
                        $r->id,
                        $r->created_at->format('d M Y h:i A'),
                        $r->full_name,
                        $r->company,
                        $r->email,
                        $r->phone_full ?: $r->phone,
                        $r->category,
                        $r->quantity,
                        $r->ship_country,
                        $r->frequency,
                        BulkEnquiry::STATUSES[$r->status] ?? $r->status,
                        $r->message,
                    ]));
                }
            });

            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }
}