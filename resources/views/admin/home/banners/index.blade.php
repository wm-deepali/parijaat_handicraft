@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
            --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
            --accent: #303d89; --accent-light: #f0f1fc;
            --green: #007a5e; --green-bg: #e3f1ec; --red: #b22222; --red-bg: #fce8e8;
            --radius-sm: 8px; --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .list-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
        .list-page * { box-sizing: border-box; }
        .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .list-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .crumb a { color: var(--accent); text-decoration: none; }
        .crumb span { margin: 0 5px; }
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; font-family: var(--font); white-space: nowrap; }
        .btn-primary-dash:hover { background: #252f70; }
        .list-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
        .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); text-align: left; white-space: nowrap; }
        .data-table tbody tr { border-bottom: 1px solid var(--border); }
        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #fafbfc; }
        .data-table td { padding: 13px 16px; font-size: 13px; vertical-align: middle; }
        .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; color: var(--text-secondary); }
        .banner-thumb { width: 110px; height: 60px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); display: block; }
        .banner-title { font-size: 13.5px; font-weight: 600; line-height: 1.4; }
        .banner-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 3px; }
        .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
        .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
        .pill-active { background: var(--green-bg); color: var(--green); }
        .pill-active::before { background: var(--green); }
        .pill-inactive { background: var(--red-bg); color: var(--red); }
        .pill-inactive::before { background: var(--red); }
        .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: var(--radius-sm); border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); cursor: pointer; text-decoration: none; font-size: 12px; }
        .action-btn.edit:hover { background: var(--accent-light); color: var(--accent); }
        .action-btn.danger:hover { background: var(--red-bg); color: var(--red); }
        .empty-state { text-align: center; padding: 56px 24px; }
        .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }
        .empty-state h6 { font-size: 14px; font-weight: 650; margin: 0 0 6px; }
        .empty-state p { font-size: 13px; color: var(--text-hint); margin: 0 0 20px; }
        .pagination-bar { padding: 14px 20px; border-top: 1px solid var(--border); }
        .flash-ok { background: var(--green-bg); color: var(--green); border-radius: var(--radius-sm); padding: 10px 16px; font-size: 13px; margin-bottom: 16px; }
        @media(max-width:768px) { .list-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">

            <div class="list-page-header">
                <div>
                    <h1>Hero Banners</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                        Hero Banners
                    </div>
                </div>
                <a href="{{ route('admin.home-banners.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Banner
                </a>
            </div>

            @if(session('success'))
                <div class="flash-ok">{{ session('success') }}</div>
            @endif

            <div class="list-card">
                <div style="overflow-x:auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:60px">ID</th>
                                <th style="width:130px">Image</th>
                                <th>Title</th>
                                <th style="width:150px">Button</th>
                                <th style="width:80px">Order</th>
                                <th style="width:110px">Status</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr id="row{{ $banner->id }}">
                                    <td><span class="id-chip">{{ $banner->id }}</span></td>
                                    <td><img src="{{ $banner->image_url }}" class="banner-thumb" alt="{{ $banner->image_alt ?: $banner->title }}"></td>
                                    <td>
                                        <div class="banner-title">{{ $banner->title }}</div>
                                        <div class="banner-sub">{{ $banner->eyebrow ?: 'No eyebrow text' }}</div>
                                    </td>
                                    <td>{{ $banner->button_text ?: '—' }}</td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>
                                        @if($banner->status)
                                            <span class="pill pill-active">Active</span>
                                        @else
                                            <span class="pill pill-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:6px">
                                            <a href="{{ route('admin.home-banners.edit', $banner->id) }}" class="action-btn edit" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="action-btn danger" title="Delete" onclick="deleteBanner({{ $banner->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <div class="empty-icon-wrap"><i class="fa fa-image"></i></div>
                                            <h6>No Banners Found</h6>
                                            <p>Add your first hero banner to show it on the home page.</p>
                                            <a href="{{ route('admin.home-banners.create') }}" class="btn-primary-dash">
                                                <i class="fa fa-plus"></i> Add Banner
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($banners->hasPages())
                    <div class="pagination-bar">
                        {{ $banners->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    function deleteBanner(id) {
        Swal.fire({
            title: 'Delete Banner?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/home-banners') }}/" + id,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: function (res) {
                        Swal.fire('Deleted!', res.message, 'success');
                        $("#row" + id).fadeOut(400, function () { $(this).remove(); });
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    }
</script>