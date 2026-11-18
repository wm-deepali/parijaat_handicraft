@php $sym = app(\App\Support\Region::class)->symbol(); @endphp

<div class="f-body">
    <div class="price-range" data-min="0" data-max="{{ $priceCeil }}" data-step="{{ $priceStep }}"
        data-gap="{{ $priceStep * 5 }}">
        <div class="range-track"><span class="range-fill"></span></div>
        <input type="range" class="range-min" min="0" max="{{ $priceCeil }}" step="{{ $priceStep }}"
            value="{{ $priceMin }}" aria-label="Minimum price" />
        <input type="range" class="range-max" min="0" max="{{ $priceCeil }}" step="{{ $priceStep }}"
            value="{{ $priceMax }}" aria-label="Maximum price" />
    </div>
    <div class="price-inputs">
        <label><span>Min</span><b>{{ $sym }}</b><input type="number" name="price_min" class="in-min"
                value="{{ $priceMin }}" min="0" max="{{ $priceCeil }}" step="{{ $priceStep }}" /></label>
        <i class="price-dash"></i>
        <label><span>Max</span><b>{{ $sym }}</b><input type="number" name="price_max" class="in-max"
                value="{{ $priceMax }}" min="0" max="{{ $priceCeil }}" step="{{ $priceStep }}" /></label>
    </div>
</div>

@once
    @push('scripts')
        <script>
            (function () {
                var range = document.querySelector(".price-range");
                if (!range) return;

                var form = range.closest("form");
                var minR = range.querySelector(".range-min");
                var maxR = range.querySelector(".range-max");
                var fill = range.querySelector(".range-fill");
                var minI = form.querySelector(".in-min");
                var maxI = form.querySelector(".in-max");
                var MIN = parseInt(range.dataset.min, 10);
                var MAX = parseInt(range.dataset.max, 10);
                var GAP = parseInt(range.dataset.gap, 10) || 1;

                function paint() {
                    var a = parseInt(minR.value, 10), b = parseInt(maxR.value, 10);
                    fill.style.left = ((a - MIN) / (MAX - MIN)) * 100 + "%";
                    fill.style.right = 100 - ((b - MIN) / (MAX - MIN)) * 100 + "%";
                    minR.style.zIndex = a > MAX - (MAX - MIN) * 0.1 ? 3 : 2;
                    maxR.style.zIndex = 2;
                }

                function fromRange(e) {
                    var a = parseInt(minR.value, 10), b = parseInt(maxR.value, 10);
                    if (b - a < GAP) {
                        if (e.target === minR) { a = b - GAP; minR.value = a; }
                        else { b = a + GAP; maxR.value = b; }
                    }
                    minI.value = a; maxI.value = b;
                    paint();
                }

                function fromInput() {
                    var a = parseInt(minI.value, 10), b = parseInt(maxI.value, 10);
                    if (isNaN(a)) a = MIN;
                    if (isNaN(b)) b = MAX;
                    a = Math.max(MIN, Math.min(a, MAX - GAP));
                    b = Math.min(MAX, Math.max(b, a + GAP));
                    minI.value = a; maxI.value = b;
                    minR.value = a; maxR.value = b;
                    paint();
                }

                minR.addEventListener("input", fromRange);
                maxR.addEventListener("input", fromRange);
                minI.addEventListener("change", fromInput);
                maxI.addEventListener("change", fromInput);
                form.addEventListener("reset", function () {
                    setTimeout(function () {
                        minR.value = MIN; maxR.value = MAX;
                        minI.value = MIN; maxI.value = MAX;
                        paint();
                    }, 0);
                });

                var d = range.closest("details");
                if (d) d.addEventListener("toggle", paint); // popup: track width is 0 while hidden
                paint();
            })();
        </script>
    @endpush
@endonce