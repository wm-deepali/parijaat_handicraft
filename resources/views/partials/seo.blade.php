@php
    $base = $seo ?? null;                    // route-level row (composer)
    $seo = $seoOverride ?? $base;            // per-record override (controller)
    $site = $general->brand ?: config('app.name');

    $fill = fn($v) => filled($v) ? str_replace('{site}', $site, $v) : null;

    $abs = function ($path) {
        if (!$path) {
            return null;
        }
        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }
        if (\Illuminate\Support\Str::startsWith($path, ['/', 'storage/', 'assets/'])) {
            return url($path);
        }

        return asset('storage/' . $path);
    };

    $fallbackImg = $general->header_logo_url ?: null;

    $title = $fill($seo->meta_title ?? null) ?: ($__env->hasSection('title') ? trim($__env->yieldContent('title')) : null) ?: $site;
    $desc = $fill($seo->meta_description ?? null) ?: (trim($__env->yieldContent('meta_description')) ?: null);
    $canonical = ($seo->canonical_url ?? null) ?: url()->current();
    $robots = ($seo->robots ?? null) ?: 'index, follow';

    // internal search result pages should not be indexed
    if (request()->filled('q')) {
        $robots = 'noindex, follow';
    }

    $ogTitle = $fill($seo->og_title ?? null) ?: $title;
    $ogDesc = $fill($seo->og_description ?? null) ?: $desc;
    $ogImage = $abs($seo->og_image ?? null) ?: $fallbackImg;

    $twTitle = $fill($seo->twitter_title ?? null) ?: $ogTitle;
    $twDesc = $fill($seo->twitter_description ?? null) ?: $ogDesc;
    $twImage = $abs($seo->twitter_image ?? null) ?: $ogImage;
@endphp

<title>{{ $title }}</title>

@if ($__env->hasSection('meta'))
    @yield('meta')
@else
    @if ($desc)
        <meta name="description" content="{{ $desc }}" />
    @endif
    @if (!empty($seo?->meta_keywords))
        <meta name="keywords" content="{{ $seo->meta_keywords }}" />
    @endif
    <meta name="robots" content="{{ $robots }}" />
    <link rel="canonical" href="{{ $canonical }}" />

    {{-- Open Graph --}}
    <meta property="og:site_name" content="{{ $site }}" />
    <meta property="og:type" content="{{ ($seo->og_type ?? null) ?: 'website' }}" />
    <meta property="og:title" content="{{ $ogTitle }}" />
    @if ($ogDesc)
        <meta property="og:description" content="{{ $ogDesc }}" />
    @endif
    <meta property="og:url" content="{{ $canonical }}" />
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}" />
    @endif

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="{{ ($seo->twitter_card ?? null) ?: 'summary_large_image' }}" />
    <meta name="twitter:title" content="{{ $twTitle }}" />
    @if ($twDesc)
        <meta name="twitter:description" content="{{ $twDesc }}" />
    @endif
    @if ($twImage)
        <meta name="twitter:image" content="{{ $twImage }}" />
    @endif

    {{-- Structured data. {site}/{url} are replaced, then re-encoded so a stray </script> can't break the page --}}
    @if (!empty($seo?->schema_markup))
        @php
            $rawSchema = str_replace(
                ['{site}', '{url}'],
                [trim(json_encode($site, JSON_UNESCAPED_UNICODE), '"'), rtrim(url('/'), '/')],
                $seo->schema_markup
            );
            $schema = json_decode($rawSchema, true);
        @endphp
        @if ($schema)
            <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
        @endif
    @endif
@endif

{{-- Custom head scripts (analytics, verification, pixels) --}}
@if (!empty($base?->scripts))
    {!! $base->scripts !!}
@endif