{{-- resources/views/partials/review-card.blade.php --}}
{{-- Usage: @include('partials.review-card', ['r' => $review, 'g' => 'rv-1-0']) --}}
<div class="rev-card">
    <div class="rev-top">
        <span class="rev-avatar">{{ $r['initials'] }}</span>
        <div>
            <h5>{{ $r['name'] }}</h5>
            <span class="rev-verified"><i class="fa-solid fa-circle-check"></i> Verified Purchase</span>
        </div>
    </div>
    <div class="rev-stars">
        @for ($s = 1; $s <= 5; $s++)
            <i class="{{ $s <= $r['stars'] ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
        @endfor
    </div>
    <h6>{{ $r['title'] }}</h6>
    <p>{{ $r['text'] }}</p>
    <ul class="rev-meta">
        @foreach ($r['meta'] as $m)
            <li>{{ $m }}</li>
        @endforeach
    </ul>
    @if (!empty($r['photos']))
        <div class="rev-photos">
            @foreach ($r['photos'] as $ph)
                <a href="{{ asset($ph) }}" class="glightbox" data-gallery="{{ $g }}">
                    <img src="{{ asset($ph) }}" alt="Review photo" loading="lazy" />
                </a>
            @endforeach
        </div>
    @endif
    <div class="rev-foot">
        <span class="rev-date">{{ $r['date'] }}</span>
        <button type="button" class="rv-helpful">
            <i class="fa-regular fa-thumbs-up"></i> Helpful ({{ $r['helpful'] }})
        </button>
    </div>
</div>