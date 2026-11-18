@if (isset($taxClasses) && $taxClasses->isNotEmpty())
    @php
        $defaultTax = $taxClasses->firstWhere('is_default', true);
        $selectedTax = old('tax_class_id', isset($product) ? $product->tax_class_id : null);
    @endphp

    <div class="field-group">
        <label class="field-label">Tax Class</label>
        <select name="tax_class_id" id="tax_class_id" class="field-select">
            <option value="">
                — Default{{ $defaultTax ? ' (' . $defaultTax->name . ', ' . ($defaultTax->gst_rate + 0) . '%)' : '' }} —
            </option>
            @foreach ($taxClasses as $tc)
                <option value="{{ $tc->id }}" {{ (string) $selectedTax === (string) $tc->id ? 'selected' : '' }}>
                    {{ $tc->name }} ({{ $tc->gst_rate + 0 }}%)
                </option>
            @endforeach
        </select>
        <div class="field-hint">Category / sub category chunne par uski tax class auto-select hoti hai. Chaho to yahan badal sakte ho.</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tax = document.getElementById('tax_class_id');
            var cat = document.getElementById('category_id');
            var sub = document.getElementById('subcategory_id');
            var manual = false;

            // admin ne khud badal di to auto-select dobara override nahi karega
            tax.addEventListener('change', function () { manual = true; });

            function taxOf(sel) {
                var o = sel && sel.options[sel.selectedIndex];
                return o ? (o.dataset.tax || '') : '';
            }

            function apply() {
                if (manual) return;
                var v = taxOf(sub) || taxOf(cat);
                tax.value = tax.querySelector('option[value="' + v + '"]') ? v : '';
            }

            cat.addEventListener('change', apply);
            sub.addEventListener('change', apply);
        });
    </script>
@endif