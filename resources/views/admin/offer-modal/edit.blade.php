@include('admin.top-header')
<div class="main-section">
    @include('admin.header')
    @include('admin.home._styles')

    @php $terms = old('terms', $offer->terms ?? []); @endphp

    <div class="app-content content container-fluid">
        <div class="detail-page">

            <div class="detail-page-header">
                <div>
                    <h1>Offer Modal</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a><span>›</span>
                        Offer Modal
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="ok-box">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="ok-box" style="background:#fef2f2;color:#b91c1c;border-color:#fecaca">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.offer-modal.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="section-card" style="padding:20px">
                    <h3 style="margin-bottom:16px">Content</h3>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title" class="form-control"
                                value="{{ old('sub_title', $offer->sub_title) }}" placeholder="Exclusive Offer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Title <span style="color:#dc2626">*</span></label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $offer->title) }}" placeholder="Welcome to Archana" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Short Content</label>
                        <textarea name="short_content" rows="3" class="form-control"
                            placeholder="Enjoy a special welcome benefit on your first order...">{{ old('short_content', $offer->short_content) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        <small style="color:var(--text-secondary)">JPG, PNG or WEBP, max 5 MB.</small>

                        @if ($offer->image_url)
                            <div style="margin-top:10px">
                                <img src="{{ $offer->image_url }}" alt="Offer image"
                                    style="max-height:140px;border-radius:8px;border:1px solid #e5e7eb">
                                <label style="display:block;margin-top:6px;font-weight:400">
                                    <input type="checkbox" name="remove_image" value="1"> Remove current image
                                </label>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="section-card" style="padding:20px;margin-top:16px">
                    <h3 style="margin-bottom:16px">Coupon</h3>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Coupon Text</label>
                            <input type="text" name="coupon_text" class="form-control"
                                value="{{ old('coupon_text', $offer->coupon_text) }}" placeholder="Extra 10% Off">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Coupon Sub Text</label>
                            <input type="text" name="coupon_sub_text" class="form-control"
                                value="{{ old('coupon_sub_text', $offer->coupon_sub_text) }}"
                                placeholder="on your first order">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Coupon Code</label>
                            <input type="text" name="coupon_code" class="form-control" style="text-transform:uppercase"
                                value="{{ old('coupon_code', $offer->coupon_code) }}" placeholder="ARCHANA10"
                                maxlength="50">
                        </div>
                    </div>
                </div>

                <div class="section-card" style="padding:20px;margin-top:16px">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                        <h3 style="margin:0">Terms</h3>
                        <button type="button" class="btn btn-primary" id="addTerm">
                            <i class="fa fa-plus"></i> Add Term
                        </button>
                    </div>

                    <div id="termsWrap">
                        @foreach ($terms as $t)
                            <div class="term-row" style="display:flex;gap:8px;margin-bottom:8px">
                                <input type="text" name="terms[]" class="form-control" value="{{ $t }}"
                                    maxlength="255" placeholder="e.g. Valid on all collections">
                                <button type="button" class="icon-btn term-remove" title="Remove"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        @endforeach
                    </div>
                    <small style="color:var(--text-secondary)">Shown as the tick list in the modal. Empty rows are
                        ignored. Max 10.</small>
                </div>

                <div class="section-card" style="padding:20px;margin-top:16px">
                    <h3 style="margin-bottom:16px">Button &amp; Status</h3>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Button Text</label>
                            <input type="text" name="button_text" class="form-control"
                                value="{{ old('button_text', $offer->button_text) }}" placeholder="Shop Now">
                        </div>
                        <div class="col-md-5 form-group">
                            <label>Button Link</label>
                            <input type="text" name="button_link" class="form-control"
                                value="{{ old('button_link', $offer->button_link) }}" placeholder="/products">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" @selected(old('is_active', (int) $offer->is_active) == 1)>Active</option>
                                <option value="0" @selected(old('is_active', (int) $offer->is_active) == 0)>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="margin-top:16px">
                    <button type="submit" class="btn btn-primary">Save Offer Modal</button>
                </div>
            </form>

        </div>
    </div>
</div>
@include('admin.footer')

<script>
    (function () {
        var wrap = document.getElementById('termsWrap'),
            addBtn = document.getElementById('addTerm'),
            MAX = 10;

        function rowHtml() {
            return '<div class="term-row" style="display:flex;gap:8px;margin-bottom:8px">' +
                '<input type="text" name="terms[]" class="form-control" maxlength="255" placeholder="e.g. Limited time offer">' +
                '<button type="button" class="icon-btn term-remove" title="Remove"><i class="fa fa-trash"></i></button>' +
                '</div>';
        }

        addBtn.addEventListener('click', function () {
            if (wrap.querySelectorAll('.term-row').length >= MAX) return;
            wrap.insertAdjacentHTML('beforeend', rowHtml());
            wrap.lastElementChild.querySelector('input').focus();
        });

        wrap.addEventListener('click', function (e) {
            var btn = e.target.closest('.term-remove');
            if (btn) btn.closest('.term-row').remove();
        });

        if (!wrap.querySelector('.term-row')) wrap.insertAdjacentHTML('beforeend', rowHtml());
    })();
</script>