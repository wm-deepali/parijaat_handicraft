{{-- resources/views/partials/blog-card.blade.php --}}
{{-- Usage: @include('partials.blog-card', ['post' => $post]) --}}
@php $d = \Carbon\Carbon::parse($post['date']); @endphp
<article class="bl-card">
    <a href="blog-detail.html" class="bl-img">
        <img src="{{ asset($post['img']) }}" alt="{{ $post['alt'] }}" loading="lazy" />
        <time class="bl-date" datetime="{{ $d->format('Y-m-d') }}"><b>{{ $d->format('d') }}</b><small>{{ $d->format('M') }}</small></time>
        <span class="bl-cat">{{ $post['cat'] }}</span>
    </a>
    <div class="bl-body">
        <div class="bl-meta">
            <span><i class="fa-regular fa-clock"></i> {{ $post['read'] }} min read</span>
            <span><i class="fa-regular fa-user"></i> Parijaat Team</span>
        </div>
        <h4><a href="blog-detail.html">{{ $post['title'] }}</a></h4>
        <p>{{ $post['excerpt'] }}</p>
        <a href="blog-detail.html" class="bl-more">
            <span>Read Article</span>
            <span class="bl-arrow"><i class="fa-solid fa-arrow-right"></i></span>
        </a>
    </div>
</article>