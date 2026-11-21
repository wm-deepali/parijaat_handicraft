{{-- resources/views/front-pages/blogs.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/blogs/blogs.css') }}" />
@endpush

@section('content')
    @php $items = $posts->getCollection(); @endphp

    <main>
        
        {{-- ================= BANNER ================= --}}
        <section class="comman-banner">
            <figure class="banner-media">
                <img src="{{ asset('assets/images/home/blog.png') }}" alt="" loading="eager" />
            </figure>

            <div class="banner-top">
                <div class="container">
                    <ul class="banner-crumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">Blogs</li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="banner-content">
                    <h1>The Parijaat Journal</h1>
                    <p>Stories, Styling &amp; Craft Inspiration.</p>
                </div>
            </div>
        </section>

        {{-- ================= SEC A : FEATURED + TRENDING ================= --}}
        @if($featured)
            <section class="blog-secA">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">FEATURED STORY</small>
                        <h3>Fresh From the Journal.</h3>
                        <p>Care guides, gifting ideas and the stories behind every handcrafted piece.</p>
                    </div>

                    <div class="bf-grid">
                        <a href="{{ $featured->url }}" class="bf-main">
                            <figure class="bf-img">
                                <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="lazy" />
                            </figure>
                            <span class="bf-tag">Featured</span>

                            <div class="bf-info">
                                <div class="bf-meta">
                                    @if($featured->category)
                                        <span class="bf-cat">{{ $featured->category }}</span>
                                    @endif
                                    <time datetime="{{ $featured->display_date->toDateString() }}"><i
                                            class="fa-regular fa-calendar"></i>
                                        {{ $featured->display_date->format('d M Y') }}</time>
                                    <span><i class="fa-regular fa-clock"></i> {{ $featured->read_time }} min read</span>
                                </div>
                                <h4>{{ $featured->title }}</h4>
                                @if($featured->excerpt)
                                    <p>{{ $featured->excerpt }}</p>
                                @endif
                                <span class="bf-cta">Read Article <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>

                        @if($trending->isNotEmpty())
                            <div class="bf-side">
                                <span class="bf-label">TRENDING NOW</span>

                                <ul class="bf-list">
                                    @foreach ($trending as $t)
                                        <li>
                                            <a href="{{ $t['url'] }}" class="bf-item">
                                                <figure>
                                                    <img src="{{ $t['img'] }}" alt="{{ $t['alt'] }}" loading="lazy" />
                                                </figure>
                                                <div>
                                                    <small>{{ $t['cat'] ? $t['cat'] . ' · ' : '' }}{{ $t['date_label'] }}</small>
                                                    <h5>{{ $t['title'] }}</h5>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        {{-- ================= SEC B : ARTICLE GRID (TABS) ================= --}}
        @if($items->isNotEmpty())
            <section class="blog-secB">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">MORE TO READ</small>
                        <h3>Latest Articles.</h3>
                    </div>

                    <ul class="tab-nav">
                        @foreach ($tabs as $id => $label)
                            <li data-tab="{{ $id }}" @class(['active' => $loop->first])>{{ $label }}</li>
                        @endforeach
                    </ul>

                    <div class="tab-nav-content">
                        @foreach ($tabs as $id => $label)
                            @php $list = $id === 1 ? $items : $items->where('cat', $label); @endphp
                            <div @class(['tabs', 'active' => $loop->first]) data-tab="{{ $id }}">
                                <div class="blog-grid">
                                    @foreach ($list as $post)
                                        @include('partials.blog-card', ['post' => $post])
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($posts->hasPages())
                        <ul class="blog-pager">
                            <li><a href="{{ $posts->previousPageUrl() ?: 'javascript:void(0);' }}" class="pg-arrow"
                                    aria-label="Previous page"><i class="fa-solid fa-chevron-left"></i></a></li>

                            @foreach (range(max(1, $posts->currentPage() - 2), min($posts->lastPage(), $posts->currentPage() + 2)) as $pg)
                                <li><a href="{{ $posts->url($pg) }}"
                                        @class(['active' => $pg === $posts->currentPage()])>{{ $pg }}</a></li>
                            @endforeach

                            <li><a href="{{ $posts->nextPageUrl() ?: 'javascript:void(0);' }}" class="pg-arrow"
                                    aria-label="Next page"><i class="fa-solid fa-chevron-right"></i></a></li>
                        </ul>
                    @endif
                </div>
            </section>
        @elseif(!$featured)
            <section class="blog-secB">
                <div class="container">
                    <div class="heading">
                        <h3>No articles yet.</h3>
                        <p>Please check back soon.</p>
                    </div>
                </div>
            </section>
        @endif

        {{-- ================= SEC C : GRADIENT CTA ================= --}}
        <section class="blog-secC">
            <div class="container">
                @include('partials.blog-cta')
            </div>
        </section>
    </main>
@endsection