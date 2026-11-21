@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    <div class="app-content content container-fluid">
        <div class="list-page">

            <div class="list-page-header">
                <div>
                    <h1>Product Deals</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                        Deals
                    </div>
                </div>
                <a href="{{ route('admin.product-deals.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Deal
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
                                <th>Product</th>
                                <th style="width:140px">Code</th>
                                <th style="width:170px">Starts</th>
                                <th style="width:170px">Ends</th>
                                <th style="width:110px">Status</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deals as $d)
                                <tr id="row{{ $d->id }}">
                                    <td><span class="id-chip">{{ $d->id }}</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:12px">
                                            @if($d->product)
                                                <img src="{{ $d->product->display_image }}" class="row-thumb" style="width:60px" alt="">
                                            @endif
                                            <div>
                                                <div class="row-title">{{ $d->product?->name ?? 'Deleted product' }}</div>
                                                <div class="row-sub">{{ $d->title ?: 'Default heading' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $d->coupon_code ?: '—' }}</td>
                                    <td>{{ $d->starts_at ? $d->starts_at->format('d M Y, h:i A') : 'Immediately' }}</td>
                                    <td>{{ $d->ends_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <span class="pill {{ $d->state === 'live' ? 'pill-active' : ($d->state === 'scheduled' ? 'pill-scheduled' : 'pill-inactive') }}">
                                            {{ ucfirst($d->state) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:6px">
                                            <a href="{{ route('admin.product-deals.edit', $d->id) }}" class="action-btn edit" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="action-btn danger" title="Delete" onclick="deleteDeal({{ $d->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <h6>No Deals Yet</h6>
                                            <p>Add a product deal to show the sale banner with a countdown on the home page.</p>
                                            <a href="{{ route('admin.product-deals.create') }}" class="btn-primary-dash">
                                                <i class="fa fa-plus"></i> Add Deal
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($deals->hasPages())
                    <div style="padding:14px 20px;border-top:1px solid var(--border)">
                        {{ $deals->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    function deleteDeal(id) {
        Swal.fire({
            title: 'Delete Deal?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/product-deals') }}/" + id,
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