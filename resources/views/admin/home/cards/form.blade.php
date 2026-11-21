@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php
        $isEdit = $card->exists;
        $has = fn($k) => in_array($k, $def['fields']);
        $lbl = fn($k, $default) => $def['labels'][$k] ?? $default;
    @endphp

    <div class="app-content content container-fluid">
        <div class="form-page">

            <h1>{{ $isEdit ? 'Edit' : 'Add' }}: {{ $def['label'] }}</h1>
            <div class="crumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                <a href="{{ route('admin.home-cards.index', $section) }}">{{ $def['label'] }}</a><span>›</span>
                {{ $isEdit ? 'Edit' : 'Add' }}
            </div>

            <form
                action="{{ $isEdit ? route('admin.home-cards.update', [$section, $card->id]) : route('admin.home-cards.store', $section) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="form-card">
                    <div class="f-row">
                        <div class="f-group">
                            <label>Title *</label>
                            <input type="text" name="title" class="f-control" value="{{ old('title', $card->title) }}"
                                required>
                            @error('title')
                            <div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group">
                            <label>{{ $lbl('text', 'Short Text') }}</label>
                            <input type="text" name="text" class="f-control" value="{{ old('text', $card->text) }}">
                            @error('text')
                            <div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        @if($has('icon'))
                            <div class="f-group full">
                                <label>Icon class <small>(Font Awesome, e.g. fa-solid fa-shield-halved)</small></label>
                                <input type="text" name="icon" class="f-control" value="{{ old('icon', $card->icon) }}">
                                @error('icon')
                                <div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('link'))
                            <div class="f-group full">
                                <label>{{ $lbl('link', 'Link (e.g. /category/brass-decor)') }}</label>
                                <input type="text" name="link" class="f-control" value="{{ old('link', $card->link) }}">
                                @error('link')
                                <div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('image'))
                            <div class="f-group full">
                                <label>{{ $lbl('image', 'Image') }} {{ $isEdit ? '' : '*' }} <small>(JPG / PNG /
                                        WEBP, max 4 MB)</small></label>
                                <input type="file" name="image" class="f-control" accept="image/*" {{ $isEdit ? '' : 'required' }}>
                                @error('image')
                                <div class="f-error">{{ $message }}</div>@enderror
                                @if($card->image_url)
                                    <img src="{{ $card->image_url }}" class="img-now" alt="">
                                @endif
                            </div>
                        @endif

                        @if($has('badge_big'))
                            <div class="f-group">
                                <label>{{ $lbl('badge_big', 'Badge big text') }}</label>
                                <input type="text" name="badge_big" class="f-control" maxlength="20"
                                    value="{{ old('badge_big', $card->badge_big) }}">
                                @error('badge_big')
                                <div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('badge_small'))
                            <div class="f-group">
                                <label>{{ $lbl('badge_small', 'Badge small text') }}</label>
                                <input type="text" name="badge_small" class="f-control" maxlength="20"
                                    value="{{ old('badge_small', $card->badge_small) }}">
                                @error('badge_small')
                                <div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        @if($has('btn_text'))
                            <div class="f-group full">
                                <label>{{ $lbl('btn_text', 'Button text') }}</label>
                                <input type="text" name="btn_text" class="f-control" maxlength="60"
                                    value="{{ old('btn_text', $card->btn_text) }}">
                                @error('btn_text')
                                <div class="f-error">{{ $message }}</div>@enderror
                            </div>
                        @endif

                        <div class="f-group">
                            <label>Sort Order</label>
                            <input type="number" min="0" name="sort_order" class="f-control"
                                value="{{ old('sort_order', $card->sort_order) }}">
                        </div>

                        <div class="f-group">
                            <label>Status</label>
                            <label class="f-switch">
                                <input type="checkbox" name="status" value="1" {{ old('status', $card->status) ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i>
                    {{ $isEdit ? 'Update' : 'Save' }}</button>
                <a href="{{ route('admin.home-cards.index', $section) }}" class="btn-cancel">Cancel</a>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')