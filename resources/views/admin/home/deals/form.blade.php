@include('admin.top-header')

<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php $isEdit = $deal->exists; @endphp

    <div class="app-content content container-fluid">
        <div class="form-page">

            <h1>{{ $isEdit ? 'Edit Deal' : 'Add Deal' }}</h1>
            <div class="crumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                <a href="{{ route('admin.home.index') }}">Home Page</a><span>›</span>
                <a href="{{ route('admin.product-deals.index') }}">Deals</a><span>›</span>
                {{ $isEdit ? 'Edit' : 'Add' }}
            </div>

            <form action="{{ $isEdit ? route('admin.product-deals.update', $deal->id) : route('admin.product-deals.store') }}"
                method="POST">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="form-card">
                    <div class="f-row">

                        <div class="f-group full">
                            <label>Product *</label>
                            <select name="product_id" class="f-control" required>
                                <option value="">Select product</option>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" @selected(old('product_id', $deal->product_id) == $p->id)>
                                        {{ $p->name }}{{ $p->sku ? ' (' . $p->sku . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group">
                            <label>Banner Heading <small>(empty = product name)</small></label>
                            <input type="text" name="title" class="f-control" maxlength="120" value="{{ old('title', $deal->title) }}">
                            @error('title')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group">
                            <label>Coupon Code <small>(optional, shown as "Use Code: ...")</small></label>
                            <input type="text" name="coupon_code" class="f-control" maxlength="60" value="{{ old('coupon_code', $deal->coupon_code) }}">
                            @error('coupon_code')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group full">
                            <label>Banner Text <small>(empty = "Grab it before the deal ends.")</small></label>
                            <input type="text" name="text" class="f-control" maxlength="255" value="{{ old('text', $deal->text) }}">
                            @error('text')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group">
                            <label>Starts At <small>(empty = start immediately)</small></label>
                            <input type="datetime-local" name="starts_at" class="f-control"
                                value="{{ old('starts_at', $deal->starts_at?->format('Y-m-d\TH:i')) }}">
                            @error('starts_at')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group">
                            <label>Ends At *</label>
                            <input type="datetime-local" name="ends_at" class="f-control" required
                                value="{{ old('ends_at', $deal->ends_at?->format('Y-m-d\TH:i')) }}">
                            @error('ends_at')<div class="f-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="f-group full">
                            <label class="f-switch">
                                <input type="checkbox" name="status" value="1" {{ old('status', $deal->status) ? 'checked' : '' }}>
                                Active
                            </label>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> {{ $isEdit ? 'Update Deal' : 'Save Deal' }}</button>
                <a href="{{ route('admin.product-deals.index') }}" class="btn-cancel">Cancel</a>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')