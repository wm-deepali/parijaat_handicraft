@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
            --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
            --accent: #303d89; --accent-light: #f0f1fc; --red: #b22222;
            --radius-sm: 8px; --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .form-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
        .form-page * { box-sizing: border-box; }
        .form-page h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .crumb { font-size: 12.5px; color: var(--text-hint); margin: 3px 0 20px; }
        .crumb a { color: var(--accent); text-decoration: none; }
        .crumb span { margin: 0 5px; }
        .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 24px; max-width: 860px; }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .f-group { margin-bottom: 16px; }
        .f-group.full { grid-column: 1 / -1; }
        .f-group label { display: block; font-size: 12.5px; font-weight: 600; margin-bottom: 6px; }
        .f-group label small { font-weight: 400; color: var(--text-hint); }
        .f-control { width: 100%; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 12px; font-size: 13px; font-family: var(--font); background: #fff; color: var(--text-primary); }
        .f-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-light); }
        textarea.f-control { min-height: 90px; resize: vertical; }
        .f-error { color: var(--red); font-size: 12px; margin-top: 4px; }
        .img-preview { margin-top: 10px; max-width: 320px; border-radius: var(--radius-sm); border: 1px solid var(--border); display: none; }
        .img-preview.show { display: block; }
        .f-switch { display: flex; align-items: center; gap: 8px; font-size: 13px; }
        .f-actions { display: flex; gap: 10px; margin-top: 8px; }
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-cancel { display: inline-flex; align-items: center; background: #fff; color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; text-decoration: none !important; }
        @media(max-width:768px) { .form-page { padding: 16px; } .f-row { grid-template-columns: 1fr; } }
    </style>

    @php $isEdit = $banner->exists; @endphp

    <div class="app-content content container-fluid">
        <div class="form-page">

            <h1>{{ $isEdit ? 'Edit Banner' : 'Add Banner' }}</h1>
            <div class="crumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                <a href="{{ route('admin.home-banners.index') }}">Hero Banners</a><span>›</span>
                {{ $isEdit ? 'Edit' : 'Add' }}
            </div>

            <form class="form-card"
                action="{{ $isEdit ? route('admin.home-banners.update', $banner->id) : route('admin.home-banners.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="f-row">
                    <div class="f-group">
                        <label>Eyebrow Text <small>(small line above the title)</small></label>
                        <input type="text" name="eyebrow" class="f-control" value="{{ old('eyebrow', $banner->eyebrow) }}">
                        @error('eyebrow')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group">
                        <label>Title *</label>
                        <input type="text" name="title" class="f-control" value="{{ old('title', $banner->title) }}" required>
                        @error('title')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group full">
                        <label>Description</label>
                        <textarea name="description" class="f-control">{{ old('description', $banner->description) }}</textarea>
                        @error('description')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" class="f-control" value="{{ old('button_text', $banner->button_text) }}">
                        @error('button_text')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group">
                        <label>Button Link <small>(e.g. /products or /category/pooja-essentials)</small></label>
                        <input type="text" name="button_link" class="f-control" value="{{ old('button_link', $banner->button_link) }}">
                        @error('button_link')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group full">
                        <label>Banner Image {{ $isEdit ? '' : '*' }} <small>(JPG / PNG / WEBP, max 4 MB)</small></label>
                        <input type="file" name="image" id="bannerImage" class="f-control" accept="image/*" {{ $isEdit ? '' : 'required' }}>
                        @error('image')<div class="f-error">{{ $message }}</div>@enderror
                        <img id="imgPreview" class="img-preview {{ $isEdit ? 'show' : '' }}"
                            src="{{ $isEdit ? $banner->image_url : '' }}" alt="Preview">
                    </div>

                    <div class="f-group full">
                        <label>Image Alt Text</label>
                        <input type="text" name="image_alt" class="f-control" value="{{ old('image_alt', $banner->image_alt) }}">
                        @error('image_alt')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group">
                        <label>Sort Order</label>
                        <input type="number" min="0" name="sort_order" class="f-control" value="{{ old('sort_order', $banner->sort_order) }}">
                        @error('sort_order')<div class="f-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="f-group">
                        <label>Status</label>
                        <label class="f-switch">
                            <input type="checkbox" name="status" value="1" {{ old('status', $banner->status) ? 'checked' : '' }}>
                            Active (show on home page)
                        </label>
                    </div>
                </div>

                <div class="f-actions">
                    <button type="submit" class="btn-primary-dash">
                        <i class="fa fa-save"></i> {{ $isEdit ? 'Update Banner' : 'Save Banner' }}
                    </button>
                    <a href="{{ route('admin.home-banners.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    document.getElementById('bannerImage').addEventListener('change', function () {
        const f = this.files[0];
        const img = document.getElementById('imgPreview');
        if (f) {
            img.src = URL.createObjectURL(f);
            img.classList.add('show');
        }
    });
</script>