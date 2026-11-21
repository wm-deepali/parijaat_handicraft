@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4;
            --surface: #ffffff;
            --border: #e3e5e8;
            --text-primary: #202223;
            --text-secondary: #6d7175;
            --text-hint: #8c9196;
            --accent: #303d89;
            --accent-light: #f0f1fc;
            --green: #007a5e;
            --red: #b22222;
            --red-bg: #fce8e8;
            --blue: #0069d9;
            --blue-bg: #e8f2ff;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .list-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
        .list-page * { box-sizing: border-box; }
        .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .list-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .crumb a { color: var(--accent); text-decoration: none; }
        .crumb a:hover { text-decoration: underline; }
        .crumb span { margin: 0 5px; }

        .btn-secondary-dash, .btn-primary-dash, .btn-danger-dash, .btn-wa {
            display: inline-flex; align-items: center; gap: 6px; border-radius: var(--radius-sm);
            padding: 8px 16px; font-size: 13px; font-weight: 500; cursor: pointer;
            text-decoration: none !important; font-family: var(--font); white-space: nowrap; transition: opacity .15s, background .15s;
        }
        .btn-secondary-dash { background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); }
        .btn-secondary-dash:hover { background: var(--bg); }
        .btn-primary-dash { background: var(--accent); color: #fff !important; border: 1px solid var(--accent); }
        .btn-danger-dash { background: var(--red); color: #fff !important; border: 1px solid var(--red); }
        .btn-wa { background: #25d366; color: #fff !important; border: 1px solid #25d366; }
        .btn-primary-dash:hover, .btn-danger-dash:hover, .btn-wa:hover { opacity: .88; }

        .detail-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; align-items: start; }
        @media(max-width:992px) { .detail-grid { grid-template-columns: 1fr; } .list-page { padding: 16px; } }

        .card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); margin-bottom: 20px; overflow: hidden; }
        .card-head { padding: 14px 20px; border-bottom: 1px solid var(--border); font-size: 14px; font-weight: 650; background: #fafafa; }
        .card-body { padding: 20px; }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px 24px; }
        @media(max-width:600px) { .info-grid { grid-template-columns: 1fr; } }
        .info-item label { display: block; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-hint); margin-bottom: 4px; }
        .info-item div, .info-item a { font-size: 14px; color: var(--text-primary); word-break: break-word; }
        .info-item a { color: var(--accent); text-decoration: none; }
        .info-item a:hover { text-decoration: underline; }
        .info-item.full { grid-column: 1 / -1; }

        .msg-box { background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 14px 16px; font-size: 14px; line-height: 1.6; white-space: pre-line; }

        .file-list { display: flex; flex-wrap: wrap; gap: 12px; }
        .file-item { width: 120px; text-decoration: none !important; }
        .file-thumb { width: 120px; height: 90px; border: 1px solid var(--border); border-radius: var(--radius-sm); background: var(--bg); display: flex; align-items: center; justify-content: center; overflow: hidden; font-size: 26px; color: var(--text-hint); }
        .file-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .file-name { font-size: 11.5px; color: var(--text-secondary); margin-top: 5px; word-break: break-all; line-height: 1.3; }

        .field { margin-bottom: 14px; }
        .field label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; }
        .field select, .field textarea { width: 100%; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 12px; font-size: 13px; font-family: var(--font); background: #fff; color: var(--text-primary); }
        .field textarea { min-height: 110px; resize: vertical; }
        .field select:focus, .field textarea:focus { outline: none; border-color: var(--accent); }
        .side-actions { display: flex; flex-direction: column; gap: 8px; }
        .side-actions a, .side-actions button { justify-content: center; width: 100%; }
        .meta-line { font-size: 12px; color: var(--text-hint); margin-top: 12px; }
    </style>

    @php
        $phoneDigits = preg_replace('/\D/', '', $enquiry->phone_full ?: $enquiry->phone);
    @endphp

    <div class="app-content content container-fluid">
        <div class="list-page">

            <div class="list-page-header">
                <div>
                    <h1>Bulk Enquiry #{{ $enquiry->id }}</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.bulk-enquiries.index') }}">Bulk Enquiries</a>
                        <span>›</span>
                        {{ $enquiry->company }}
                    </div>
                </div>
                <a href="{{ route('admin.bulk-enquiries.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="detail-grid">

                <!-- LEFT -->
                <div>
                    <div class="card">
                        <div class="card-head">Customer Details</div>
                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Full Name</label>
                                    <div>{{ $enquiry->full_name }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Company</label>
                                    <div>{{ $enquiry->company }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Email</label>
                                    <a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a>
                                </div>
                                <div class="info-item">
                                    <label>Phone</label>
                                    <a href="tel:{{ $enquiry->phone_full ?: $enquiry->phone }}">{{ $enquiry->phone_full ?: $enquiry->phone }}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">Requirement</div>
                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Product Category</label>
                                    <div>{{ $enquiry->category }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Quantity</label>
                                    <div>{{ number_format($enquiry->quantity) }} pcs</div>
                                </div>
                                <div class="info-item">
                                    <label>Ship To</label>
                                    <div>{{ $enquiry->ship_country }}</div>
                                </div>
                                <div class="info-item">
                                    <label>Order Frequency</label>
                                    <div>{{ $enquiry->frequency ?: '—' }}</div>
                                </div>
                                <div class="info-item full">
                                    <label>Product names / SKUs, size, customization</label>
                                    @if ($enquiry->message)
                                        <div class="msg-box">{{ $enquiry->message }}</div>
                                    @else
                                        <div style="color:var(--text-hint)">—</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($enquiry->files)
                        <div class="card">
                            <div class="card-head">Attachments ({{ count($enquiry->files) }})</div>
                            <div class="card-body">
                                <div class="file-list">
                                    @foreach ($enquiry->file_urls as $f)
                                        @php $isImg = preg_match('/\.(jpe?g|png|webp)$/i', $f['name']); @endphp
                                        <a href="{{ $f['url'] }}" target="_blank" rel="noopener" class="file-item"
                                            title="{{ $f['name'] }}">
                                            <div class="file-thumb">
                                                @if ($isImg)
                                                    <img src="{{ $f['url'] }}" alt="{{ $f['name'] }}">
                                                @else
                                                    <i class="fa fa-file-o"></i>
                                                @endif
                                            </div>
                                            <div class="file-name">{{ $f['name'] }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- RIGHT -->
                <div>
                    <div class="card">
                        <div class="card-head">Follow-up</div>
                        <div class="card-body">
                            <form id="updateForm">
                                <div class="field">
                                    <label for="status">Status</label>
                                    <select name="status" id="status">
                                        @foreach (\App\Models\BulkEnquiry::STATUSES as $key => $label)
                                            <option value="{{ $key }}" @selected($enquiry->status === $key)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="admin_note">Internal Note</label>
                                    <textarea name="admin_note" id="admin_note"
                                        placeholder="Quote sent, follow-up date, etc.">{{ $enquiry->admin_note }}</textarea>
                                </div>
                                <button type="submit" class="btn-primary-dash" id="saveBtn" style="width:100%;justify-content:center">
                                    <i class="fa fa-save"></i> Save Changes
                                </button>
                            </form>

                            <div class="meta-line">
                                Received {{ $enquiry->created_at->format('d M Y, h:i A') }}
                                @if ($enquiry->ip_address) · IP {{ $enquiry->ip_address }} @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">Quick Actions</div>
                        <div class="card-body">
                            <div class="side-actions">
                                <a href="mailto:{{ $enquiry->email }}?subject={{ rawurlencode('Your Bulk Quote Request') }}"
                                    class="btn-secondary-dash"><i class="fa fa-envelope"></i> Reply by Email</a>
                                @if ($phoneDigits)
                                    <a href="https://wa.me/{{ $phoneDigits }}" target="_blank" rel="noopener"
                                        class="btn-wa"><i class="fa fa-whatsapp"></i> WhatsApp</a>
                                @endif
                                <button type="button" class="btn-danger-dash" onclick="deleteEnquiry()">
                                    <i class="fa fa-trash"></i> Delete Enquiry
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
    $('#updateForm').on('submit', function (e) {
        e.preventDefault();

        var $btn = $('#saveBtn');
        $btn.prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.bulk-enquiries.update', $enquiry->id) }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PUT",
                status: $('#status').val(),
                admin_note: $('#admin_note').val()
            },
            success: function (res) {
                Swal.fire({ icon: 'success', title: 'Saved', text: res.message, timer: 1500, showConfirmButton: false });
            },
            error: function (xhr) {
                var j = xhr.responseJSON || {};
                var msg = (j.errors && Object.values(j.errors)[0][0]) || j.message || 'Something went wrong';
                Swal.fire('Error', msg, 'error');
            },
            complete: function () { $btn.prop('disabled', false); }
        });
    });

    function deleteEnquiry() {
        Swal.fire({
            title: 'Delete Enquiry?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.bulk-enquiries.destroy', $enquiry->id) }}",
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function () {
                        window.location.href = "{{ route('admin.bulk-enquiries.index') }}";
                    },
                    error: function () {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            }
        });
    }
</script>