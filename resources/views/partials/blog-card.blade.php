{{-- resources/views/partials/blog-card.blade.php --}}
{{-- Usage: @include('partials.blog-card', ['post' => $post]) --}}
@php
    $d = \Carbon\Carbon::parse($post['date']);
    $author = $post['author'] ?? config('app.name');
@endphp
<article class="bl-card">
    <a href="{{ $post['url'] }}" class="bl-img">
        <img src="{{ asset($post['img']) }}" alt="{{ $post['alt'] }}" loading="lazy" />
        <time class="bl-date" datetime="{{ $d->format('Y-m-d') }}"><b>{{ $d->format('d') }}</b><small>{{ $d->format('M') }}</small></time>
        @if(!empty($post['cat']))
            <span class="bl-cat">{{ $post['cat'] }}</span>
        @endif
    </a>
    <div class="bl-body">
        <div class="bl-meta">
            <span><i class="fa-regular fa-clock"></i> {{ $post['read'] }} min read</span>
            <span><i class="fa-regular fa-user"></i> {{ $author }}</span>
        </div>
        <h4><a href="{{ $post['url'] }}">{{ $post['title'] }}</a></h4>
        @if(!empty($post['excerpt']))
            <p>{{ $post['excerpt'] }}</p>
        @endif
        <a href="{{ $post['url'] }}" class="bl-more">
            <span>Read Article</span>
            <span class="bl-arrow"><i class="fa-solid fa-arrow-right"></i></span>
        </a>
    </div>
</article>