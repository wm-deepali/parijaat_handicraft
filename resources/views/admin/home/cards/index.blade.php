@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php $hasImage = in_array('image', $def['fields']); @endphp

    <div class="app-content content container-fluid">
        <div class="list-page">

            <div class="list-page-header">
                <div>
                    <h1>{{ $def['label'] }}</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                        {{ $def['label'] }}
                    </div>
                </div>
                <a href="{{ route('admin.home-cards.create', $section) }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add New
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
                                <th style="width:110px">{{ $hasImage ? 'Image' : 'Icon' }}</th>
                                <th>Title</th>
                                <th style="width:80px">Order</th>
                                <th style="width:110px">Status</th>
                                <th style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cards as $card)
                                <tr id="row{{ $card->id }}">
                                    <td><span class="id-chip">{{ $card->id }}</span></td>
                                    <td>
                                        @if($hasImage)
                                            @if($card->image_url)
                                                <img src="{{ $card->image_url }}" class="row-thumb" alt="">
                                            @endif
                                        @else
                                            <div class="row-icon"><i class="{{ $card->icon ?: 'fa-solid fa-gem' }}"></i></div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row-title">{{ $card->title }}</div>
                                        <div class="row-sub">{{ $card->text }}</div>
                                    </td>
                                    <td>{{ $card->sort_order }}</td>
                                    <td>
                                        @if($card->status)
                                            <span class="pill pill-active">Active</span>
                                        @else
                                            <span class="pill pill-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:6px">
                                            <a href="{{ route('admin.home-cards.edit', [$section, $card->id]) }}" class="action-btn edit" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="action-btn danger" title="Delete" onclick="deleteCard({{ $card->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <h6>Nothing added yet</h6>
                                            <p>Add the first item to show it on the home page.</p>
                                            <a href="{{ route('admin.home-cards.create', $section) }}" class="btn-primary-dash">
                                                <i class="fa fa-plus"></i> Add New
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    function deleteCard(id) {
        Swal.fire({
            title: 'Delete?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/home-cards/' . $section) }}/" + id,
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