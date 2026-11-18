@if (isset($taxClasses) && $taxClasses->isNotEmpty())
    @php
        $defaultClass = $taxClasses->firstWhere('is_default', true);
        $selectedTax = old('tax_class_id', isset($category) ? $category->tax_class_id : null);
    @endphp

    <div class="field-group">
        <label class="field-label">Tax Class</label>
        <select name="tax_class_id" class="field-select">
            <option value="">
                — Default{{ $defaultClass ? ' (' . $defaultClass->name . ', ' . ($defaultClass->gst_rate + 0) . '%)' : '' }} —
            </option>
            @foreach ($taxClasses as $tc)
                <option value="{{ $tc->id }}" {{ (string) $selectedTax === (string) $tc->id ? 'selected' : '' }}>
                    {{ $tc->name }} ({{ $tc->gst_rate + 0 }}%)
                </option>
            @endforeach
        </select>
        <div class="field-hint">Products in this category use this GST rate unless the product has its own tax class.</div>
    </div>
@endif