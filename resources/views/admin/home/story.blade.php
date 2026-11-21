@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
            --text-primary: #202223; --text-hint: #8c9196;
            --accent: #303d89; --accent-light: #f0f1fc; --red: #b22222; --green: #007a5e; --green-bg: #e3f1ec;
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
        .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 24px; max-width: 900px; margin-bottom: 16px; }
        .form-card h2 { font-size: 14px; font-weight: 650; margin: 0 0 16px; padding-bottom: 10px; border-bottom: 1px solid var(--border); }
        .f-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .f-row.three { grid-template-columns: 160px 1fr 1.4fr; }
        .f-group { margin-bottom: 16px; }
        .f-group.full { grid-column: 1 / -1; }
        .f-group label { display: block; font-size: 12.5px; font-weight: 600; margin-bottom: 6px; }
        .f-group label small { font-weight: 400; color: var(--text-hint); }
        .f-control { width: 100%; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 12px; font-size: 13px; font-family: var(--font); background: #fff; color: var(--text-primary); }
        .f-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-light); }
        textarea.f-control { min-height: 100px; resize: vertical; }
        .f-error { color: var(--red); font-size: 12px; margin-top: 4px; }
        .img-now { margin-top: 10px; max-width: 220px; border-radius: var(--radius-sm); border: 1px solid var(--border); display: block; }
        .f-switch { display: flex; align-items: center; gap: 8px; font-size: 13px; }
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-cancel { display: inline-flex; align-items: center; background: #fff; color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; text-decoration: none !important; margin-left: 8px; }
        .flash-ok { background: var(--green-bg); color: var(--green); border-radius: var(--radius-sm); padding: 10px 16px; font-size: 13px; margin-bottom: 16px; max-width: 900px; }
        @media(max-width:768px) { .form-page { padding: 16px; } .f-row, .f-row.three { grid-template-columns: 1fr; } }
    </style>

    @php
        $pillars = old('pillars', $story->pillars ?? []);
        $pillars = array_pad(array_values($pillars), 3, ['icon' => '', 'title' => '', 'text' => '']);
    @endphp

    <div class="app-content content container-fluid">
        <div class="form-page">

            <h1>Brand Story</h1>
            <div class="crumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                Brand Story
            </div>

            @if(session('success'))
                <div class="flash-ok">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.home-story.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-card">
                    <h2>Content</h2>
                    <div class="f-row">
                        <div class="f-group">
                            <label>Eyebrow Text</label>
                            <input type="text" name="eyebrow" class="f-control" value="{{ old('eyebrow', $story->eyebrow) }}">
                            @error('eyebrow')<div class="f-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="f-group">
                            <label>Title *</label>
                            <input type="text" name="title" class="f-control" value="{{ old('title', $story->title) }}" required>
                            @error('title')<div class="f-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="f-group full">
                            <label>Description</label>
                            <textarea name="description" class="f-control">{{ old('description', $story->description) }}</textarea>
                            @error('description')<div class="f-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <h2>Images</h2>
                    <div class="f-row">
                        <div class="f-group">
                            <label>Main Image <small>(large arch image)</small></label>
                            <input type="file" name="main_image" class="f-control" accept="image/*">
                            @error('main_image')<div class="f-error">{{ $message }}</div>@enderror
                            @if($story->main_image_url)
                                <img src="{{ $story->main_image_url }}" class="img-now" alt="">
                            @endif
                        </div>
                        <div class="f-group">
                            <label>Main Image Alt Text</label>
                            <input type="text" name="main_image_alt" class="f-control" value="{{ old('main_image_alt', $story->main_image_alt) }}">
                        </div>
                        <div class="f-group">
                            <label>Detail Image <small>(small tilted photo, optional)</small></label>
                            <input type="file" name="detail_image" class="f-control" accept="image/*">
                            @error('detail_image')<div class="f-error">{{ $message }}</div>@enderror
                            @if($story->detail_image_url)
                                <img src="{{ $story->detail_image_url }}" class="img-now" alt="">
                            @endif
                        </div>
                        <div class="f-group">
                            <label>Detail Image Alt Text</label>
                            <input type="text" name="detail_image_alt" class="f-control" value="{{ old('detail_image_alt', $story->detail_image_alt) }}">
                        </div>
                        <div class="f-group full">
                            <label>Rotating Badge Text <small>(e.g. HANDCRAFTED IN INDIA)</small></label>
                            <input type="text" name="badge_text" class="f-control" value="{{ old('badge_text', $story->badge_text) }}">
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <h2>Pillars <small style="font-weight:400;color:var(--text-hint)">(up to 3, rows without a title are ignored)</small></h2>
                    @foreach($pillars as $i => $pl)
                        <div class="f-row three">
                            <div class="f-group">
                                <label>Icon class <small>(Font Awesome)</small></label>
                                <input type="text" name="pillars[{{ $i }}][icon]" class="f-control" placeholder="fa-solid fa-hammer"
                                    value="{{ $pl['icon'] ?? '' }}">
                            </div>
                            <div class="f-group">
                                <label>Title</label>
                                <input type="text" name="pillars[{{ $i }}][title]" class="f-control" value="{{ $pl['title'] ?? '' }}">
                            </div>
                            <div class="f-group">
                                <label>Short Text</label>
                                <input type="text" name="pillars[{{ $i }}][text]" class="f-control" value="{{ $pl['text'] ?? '' }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-card">
                    <h2>Buttons</h2>
                    <div class="f-row">
                        <div class="f-group">
                            <label>Primary Button Text</label>
                            <input type="text" name="primary_btn_text" class="f-control" value="{{ old('primary_btn_text', $story->primary_btn_text) }}">
                        </div>
                        <div class="f-group">
                            <label>Primary Button Link</label>
                            <input type="text" name="primary_btn_link" class="f-control" value="{{ old('primary_btn_link', $story->primary_btn_link) }}">
                        </div>
                        <div class="f-group">
                            <label>Secondary Button Text</label>
                            <input type="text" name="secondary_btn_text" class="f-control" value="{{ old('secondary_btn_text', $story->secondary_btn_text) }}">
                        </div>
                        <div class="f-group">
                            <label>Secondary Button Link</label>
                            <input type="text" name="secondary_btn_link" class="f-control" value="{{ old('secondary_btn_link', $story->secondary_btn_link) }}">
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <label class="f-switch">
                        <input type="checkbox" name="status" value="1" {{ old('status', $story->status) ? 'checked' : '' }}>
                        Show this section on the home page
                    </label>
                </div>

                <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> Save Story</button>
                <a href="{{ route('admin.home.index') }}" class="btn-cancel">Back</a>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')