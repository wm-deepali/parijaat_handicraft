@if (!empty($defaultCurrency))
    <div class="field-hint" style="margin:10px 0 14px;">
        Default currency is <b>{{ $defaultCurrency->code }}</b>. Enter price in {{ $defaultCurrency->code }}.
    </div>
@endif