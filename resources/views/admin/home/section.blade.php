@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php
        $f = $def['fields'];
        $L = $def['labels'] ?? [];
        $has = fn($k) => in_array($k, $f);
    @endphp

    <div class="app-content content container-fluid">
        <div class="form-page">

            <h1>{{ $def['label'] }}</h1>
            <div class="crumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                {{ $def['label'] }}
            </div>

            @if(session('success'))
                <div class="flash-ok" style="max-width:860px">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.home-sections.update', $key) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-card">
                    <div class="f-row">

                        @if($has('eyebrow'))
                            <div class="f-group">
                                <label>{{ $L['eyebrow'] ?? 'Eyebrow Text' }}</label>
                                <input type="text" name="eyebrow" class="f-control" value="{{ old('eyebrow', $section->eyebrow) }}">
                                @error('eyebrow')<div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('title'))
                            <div class="f-group">
                                <label>{{ $L['title'] ?? 'Title' }} *</label>
                                <input type="text" name="title" class="f-control" value="{{ old('title', $section->title) }}" required>
                                @error('title')<div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('description'))
                            <div class="f-group full">
                                <label>{{ $L['description'] ?? 'Description' }}</label>
                                <textarea name="description" class="f-control">{{ old('description', $section->description) }}</textarea>
                                @error('description')<div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('image'))
                            <div class="f-group">
                                <label>Image <small>(JPG / PNG / WEBP, max 4 MB)</small></label>
                                <input type="file" name="image" class="f-control" accept="image/*">
                                @error('image')<div class="f-error">{{ $message }}</div>@enderror
                                @if($section->image_url)
                                    <img src="{{ $section->image_url }}" class="img-now" alt="">
                                @endif
                            </div>
                            <div class="f-group">
                                <label>Image Alt Text</label>
                                <input type="text" name="image_alt" class="f-control" value="{{ old('image_alt', $section->image_alt) }}">
                            </div>
                        @endif

                        @if($has('btn1'))
                            <div class="f-group">
                                <label>{{ $L['btn1'] ?? 'Primary Button Text' }}</label>
                                <input type="text" name="btn1_text" class="f-control" value="{{ old('btn1_text', $section->btn1_text) }}">
                            </div>
                            <div class="f-group">
                                <label>Primary Button Link</label>
                                <input type="text" name="btn1_link" class="f-control" value="{{ old('btn1_link', $section->btn1_link) }}">
                            </div>
                        @endif

                        @if($has('btn2'))
                            <div class="f-group">
                                <label>{{ $L['btn2'] ?? 'Secondary Button Text' }}</label>
                                <input type="text" name="btn2_text" class="f-control" value="{{ old('btn2_text', $section->btn2_text) }}">
                            </div>
                            <div class="f-group">
                                <label>Secondary Button Link</label>
                                <input type="text" name="btn2_link" class="f-control" value="{{ old('btn2_link', $section->btn2_link) }}">
                            </div>
                        @endif

                        @if($has('lines'))
                            <div class="f-group full">
                                <label>{{ $L['lines'] ?? 'List (one per line)' }}</label>
                                <textarea name="lines" class="f-control">{{ old('lines', implode("\n", $section->lines ?? [])) }}</textarea>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-card">
                    <label class="f-switch">
                        <input type="checkbox" name="status" value="1" {{ old('status', $section->status) ? 'checked' : '' }}>
                        Show on the home page
                    </label>
                </div>

                <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> Save</button>
                <a href="{{ route('admin.home.index') }}" class="btn-cancel">Back</a>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')