{{-- resources/views/front-pages/blog-detail.blade.php --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/blog-detail/blog-detail.css') }}" />
@endpush

@section('content')
    @php
        $date = $blog->display_date;
        $authorName = $blog->author ?: config('app.name');
        $shareUrl = urlencode($blog->url);
        $shareText = urlencode($blog->title);
    @endphp

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
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><i class="fa-solid fa-chevron-right"></i></li>
                        <li class="current">{{ $blog->title }}</li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <div class="banner-content">
                    <h1>{{ $blog->title }}</h1>
                    <p>
                        @if($blog->category){{ $blog->category }} &nbsp;·&nbsp; @endif{{ $date->format('d M Y') }}
                        &nbsp;·&nbsp; {{ $blog->read_time }} min read
                    </p>
                </div>
            </div>
        </section>

        {{-- ================= SEC A : ARTICLE + SIDEBAR ================= --}}
        <section class="blogd-secA">
            <div class="container">
                <div class="bd-grid">
                    <article class="bd-article">
                        <figure class="bd-cover">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" />
                        </figure>

                        <div class="bd-byline">
                            <span><i class="fa-regular fa-user"></i> By {{ $authorName }}</span>
                            <time datetime="{{ $date->toDateString() }}"><i class="fa-regular fa-calendar"></i>
                                {{ $date->format('d M Y') }}</time>
                            <span><i class="fa-regular fa-clock"></i> {{ $blog->read_time }} min read</span>
                            @if($blog->category)
                                <span class="bd-pill">{{ $blog->category }}</span>
                            @endif
                        </div>

                        {{-- CMS CONTENT AREA --}}
                        <div class="blogd-content">
                            {!! $content !!}
                        </div>

                        <div class="blogd-foot">
                            @if(count($blog->tags_list))
                                <ul class="blogd-tags" aria-label="Tags">
                                    @foreach ($blog->tags_list as $tag)
                                        <li><a href="javascript:void(0);">{{ $tag }}</a></li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="blogd-share">
                                <span>Share:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank"
                                    rel="noopener noreferrer" aria-label="Share on Facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                                    target="_blank" rel="noopener noreferrer" aria-label="Share on X"><i
                                        class="fa-brands fa-x-twitter"></i></a>
                                <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank"
                                    rel="noopener noreferrer" aria-label="Share on WhatsApp"><i
                                        class="fa-brands fa-whatsapp"></i></a>
                                <button type="button" class="copyLink" aria-label="Copy link"><i
                                        class="fa-solid fa-link"></i></button>
                            </div>
                        </div>

                        <div class="blogd-author">
                            <span class="blogd-avatar"><i class="fa-regular fa-user"></i></span>
                            <div>
                                <small>Written by</small>
                                <h4>{{ $authorName }}</h4>
                            </div>
                        </div>
                    </article>

                    <aside class="bd-side">
                        @if(count($toc))
                            <div class="bd-box">
                                <h5><i class="fa-solid fa-list-ul"></i> In This Article</h5>
                                <ol class="bd-toc">
                                    @foreach ($toc as $anchor => $label)
                                        <li><a href="#{{ $anchor }}">{{ $label }}</a></li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif

                        @if($popular->isNotEmpty())
                            <div class="bd-box">
                                <h5><i class="fa-solid fa-fire"></i> Popular Posts</h5>
                                <ul class="bd-pop">
                                    @foreach ($popular as $p)
                                        <li>
                                            <a href="{{ $p['url'] }}">
                                                <figure>
                                                    <img src="{{ $p['img'] }}" alt="{{ $p['alt'] }}" loading="lazy" />
                                                </figure>
                                                <div>
                                                    <small>{{ $p['date_label'] }}</small>
                                                    <h6>{{ $p['title'] }}</h6>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="bd-quote">
                            <i class="fa-solid fa-boxes-stacked bd-quote-mark" aria-hidden="true"></i>
                            <small>WHOLESALE &amp; BULK</small>
                            <h5>Looking for Handicrafts in Bulk?</h5>
                            <p>Share your requirements and we will reply with pricing and availability.</p>
                            <button type="button" class="btn btn-white" data-model=".enquiry-pop">
                                Request a Bulk Quote <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        {{-- ================= SEC B : RELATED (fourSlider) ================= --}}
        @if($related->isNotEmpty())
            <section class="blogd-secB">
                <div class="container">
                    <div class="heading">
                        <small class="eyebrow">KEEP READING</small>
                        <h3>Related Articles.</h3>
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSlider" data-mob="1.15" data-sm="2.1" data-lg="3" data-xl="4">
                            <div class="swiper-wrapper">
                                @foreach ($related as $post)
                                    <div class="swiper-slide">
                                        @include('partials.blog-card', ['post' => $post])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="btn-prev" aria-label="Previous"><i
                                    class="fa-solid fa-chevron-left"></i></button>
                            <button type="button" class="btn-next" aria-label="Next"><i
                                    class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- ================= SEC C : GRADIENT CTA ================= --}}
        <section class="blogd-secC">
            <div class="container">
                @include('partials.blog-cta')
            </div>
        </section>
    </main>
@endsection