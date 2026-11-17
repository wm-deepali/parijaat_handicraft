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
            --green-bg: #e3f1ec;
            --red: #b22222;
            --red-bg: #fce8e8;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .edit-page {
            background: var(--bg);
            padding: 24px 28px;
            min-height: 100vh;
            font-family: var(--font);
            color: var(--text-primary);
        }

        .edit-page * {
            box-sizing: border-box;
        }

        .edit-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .edit-page-header h1 {
            font-size: 20px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
        }

        .crumb {
            font-size: 12.5px;
            color: var(--text-hint);
            margin-top: 3px;
        }

        .crumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .crumb a:hover {
            text-decoration: underline;
        }

        .crumb span {
            margin: 0 5px;
        }

        .btn-primary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
            box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
        }

        .btn-primary-dash:hover:not(:disabled) {
            background: #252f70;
        }

        .btn-primary-dash:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .btn-secondary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface);
            color: var(--text-primary) !important;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
        }

        .btn-secondary-dash:hover {
            background: var(--bg);
        }

        .edit-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }

        @media(max-width:960px) {
            .edit-layout {
                grid-template-columns: 1fr;
            }
        }

        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-card-header h5 {
            font-size: 13px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
        }

        .section-card-body {
            padding: 20px;
        }

        .field-group {
            margin-bottom: 16px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: .03em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .field-label .req {
            color: var(--red);
            margin-left: 2px;
        }

        .field-input,
        .field-select,
        .field-textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            font-family: var(--font);
        }

        .field-input,
        .field-select {
            height: 38px;
        }

        .field-textarea {
            padding: 10px 12px;
            resize: vertical;
            min-height: 90px;
        }

        .field-input:focus,
        .field-select:focus,
        .field-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .field-hint {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 4px;
        }

        .media-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 4px;
        }

        .thumb-box {
            position: relative;
        }

        .thumb-box img {
            width: 160px;
            height: 110px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
            display: block;
        }

        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        .upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon {
            font-size: 20px;
            color: var(--text-hint);
            margin-bottom: 4px;
        }

        .upload-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .upload-sub {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 2px;
        }

        .check-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
            cursor: pointer;
            transition: border-color .15s, background .15s;
            font-size: 13px;
            color: var(--text-primary);
            user-select: none;
            margin: 0;
        }

        .check-pill:hover {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        .check-pill input[type="checkbox"] {
            accent-color: var(--accent);
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            cursor: pointer;
            margin: 0;
        }

        .check-pill:has(input:checked) {
            border-color: var(--accent);
            background: var(--accent-light);
            font-weight: 600;
            color: var(--accent);
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toggle-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .toggle-sub {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 2px;
        }

        .field-select-sm {
            height: 32px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 28px 0 10px;
            font-size: 12.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            font-family: var(--font);
            transition: border-color .15s, box-shadow .15s;
            min-width: 100px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 9px center;
        }

        .field-select-sm:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .action-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        @media(max-width:768px) {
            .edit-page {
                padding: 16px;
            }
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="edit-page">

            <!-- Page header -->
            <div class="edit-page-header">
                <div>
                    <h1>{{ $link->exists ? 'Edit' : 'Add' }} Affiliate Link</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.affiliate-links.index') }}">Affiliate Links</a>
                        <span>›</span>
                        {{ $link->exists ? 'Edit' : 'Add' }} Link
                    </div>
                </div>
            </div>

            {{-- Validation errors summary --}}
            @if ($errors->any())
                <div class="section-card" style="border-color:#f3b9b9;">
                    <div class="section-card-body" style="padding:14px 20px;">
                        <strong style="color:var(--red);font-size:13px;">Please fix the following:</strong>
                        <ul style="margin:8px 0 0 18px; padding:0; font-size:13px; color:var(--red);">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data" class="save-form" id="affiliateForm"
                action="{{ $link->exists ? route('admin.affiliate-links.update', $link->id) : route('admin.affiliate-links.store') }}">
                @csrf
                @if ($link->exists) @method('PUT') @endif

                <div class="edit-layout">

                    <!-- ══════════ LEFT COLUMN ══════════ -->
                    <div>

                        <!-- Link details -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Link Details</h5>
                            </div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Link (URL) <span class="req">*</span></label>
                                    <input type="url" name="url" class="field-input" required
                                        value="{{ old('url', $link->url) }}" placeholder="https://...">
                                    <div class="field-hint">The image, title and description are read automatically from
                                        this link when you save.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Title</label>
                                    <input type="text" name="title" class="field-input"
                                        value="{{ old('title', $link->title) }}">
                                    <div class="field-hint">Optional — taken from the link if left empty.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Description</label>
                                    <textarea name="description" rows="3"
                                        class="field-textarea">{{ old('description', $link->description) }}</textarea>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Partner Price</label>
                                    <input type="number" step="0.01" min="0" name="price" class="field-input"
                                        value="{{ old('price', $link->price) }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Old Price (MRP)</label>
                                    <input type="number" step="0.01" min="0" name="mrp" class="field-input"
                                        value="{{ old('mrp', $link->mrp) }}">
                                    <div class="field-hint">Optional. % OFF apne aap calculate hoga.</div>
                                </div>

                            </div>
                        </div>

                        <!-- Media -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Image</h5>
                            </div>
                            <div class="section-card-body">

                                @if ($link->image_url)
                                    <div class="field-group">
                                        <label class="field-label">Current Image</label>
                                        <div class="media-grid">
                                            <div class="thumb-box">
                                                <img src="{{ $link->image_url }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="field-group">
                                    <label class="field-label">Upload New Image</label>
                                    <div class="upload-area">
                                        <input type="file" id="image" name="image" accept="image/*">
                                        <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                        <div class="upload-label">Click or drag to upload</div>
                                        <div class="upload-sub">PNG, JPG, WEBP &middot; optional, only to replace the
                                            one from the link</div>
                                    </div>
                                    <div id="imagePreview" class="media-grid"></div>
                                </div>

                            </div>
                        </div>

                    </div><!-- /left column -->

                    <!-- ══════════ RIGHT COLUMN ══════════ -->
                    <div>

                        <!-- Status -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Status</h5>
                            </div>
                            <div class="section-card-body" style="padding:14px 20px">
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-label">Visibility</div>
                                        <div class="toggle-sub">Shown on storefront</div>
                                    </div>
                                    <select name="status" class="field-select-sm">
                                        <option value="1" {{ old('status', $link->status) ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ !old('status', $link->status) ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Display -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Display</h5>
                            </div>
                            <div class="section-card-body">
                                <div class="field-group">
                                    <label class="field-label">Sort Order</label>
                                    <input type="number" name="sort_order" min="0" class="field-input"
                                        value="{{ old('sort_order', $link->sort_order) }}">
                                    <div class="field-hint">Lower number shows first.</div>
                                </div>
                            </div>
                        </div>

                        @if ($link->exists)
                            <!-- Refresh -->
                            <div class="section-card">
                                <div class="section-card-header">
                                    <h5>Refresh</h5>
                                </div>
                                <div class="section-card-body">
                                    <label class="check-pill">
                                        <input type="checkbox" name="refetch" value="1" {{ old('refetch') ? 'checked' : '' }}>
                                        <span>Refresh title, description and image from the link</span>
                                    </label>
                                </div>
                            </div>
                        @endif

                    </div><!-- /right column -->

                </div><!-- /edit-layout -->

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.affiliate-links.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" id="saveBtn" class="btn-primary-dash save-btn">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    // Submit spinner
    document.getElementById('affiliateForm').addEventListener('submit', function () {
        var btn = document.getElementById('saveBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    });

    // New image preview
    document.getElementById('image').addEventListener('change', function (e) {
        var box = document.getElementById('imagePreview');
        box.innerHTML = '';
        var file = e.target.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function (ev) {
            box.innerHTML = '<div class="thumb-box"><img src="' + ev.target.result + '" alt=""></div>';
        };
        reader.readAsDataURL(file);
    });
</script>