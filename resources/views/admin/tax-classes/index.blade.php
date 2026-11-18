@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        .cc-page { background:#f1f2f4; padding:24px 28px; min-height:100vh; font-family:'Inter',system-ui,sans-serif; color:#202223; }
        .cc-page * { box-sizing:border-box; }
        .cc-page h1 { font-size:20px; margin:0 0 4px; font-weight:650; }
        .cc-sub { font-size:12.5px; color:#6d7175; margin-bottom:16px; }
        .cc-card { background:#fff; border:1px solid #e3e5e8; border-radius:12px; margin-bottom:16px; overflow:hidden; }
        .cc-head { padding:14px 20px; background:#fafafa; border-bottom:1px solid #e3e5e8; }
        .cc-head h5 { margin:0; font-size:13px; font-weight:650; }
        .cc-table { width:100%; border-collapse:collapse; font-size:13px; }
        .cc-table th { background:#fafafa; text-align:left; font-size:11px; letter-spacing:.05em; text-transform:uppercase; color:#8c9196; padding:10px 12px; border-bottom:1px solid #e3e5e8; }
        .cc-table td { padding:8px 12px; border-bottom:1px solid #f0f1f3; vertical-align:middle; }
        .cc-table input[type=number], .cc-table input[type=text] { height:34px; border:1px solid #e3e5e8; border-radius:8px; padding:0 8px; font-size:13px; }
        .cc-table input[type=number] { width:100px; }
        .cc-table input[type=text] { width:220px; }
        .cc-note { font-size:11.5px; color:#8c9196; padding:10px 20px; border-top:1px solid #e3e5e8; background:#fafafa; }
        .cc-bar { background:#fff; border:1px solid #e3e5e8; border-radius:12px; padding:14px 20px; display:flex; justify-content:flex-end; gap:10px; }
        .cc-btn { display:inline-flex; align-items:center; gap:6px; border-radius:8px; padding:9px 18px; font-size:13px; font-weight:600; cursor:pointer; border:1px solid #e3e5e8; background:#fff; color:#202223; }
        .cc-btn.primary { background:#303d89; color:#fff; border-color:#303d89; }
        .cc-btn.danger { color:#b22222; padding:6px 12px; }
        .cc-alert { padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:12px; }
        .cc-alert.ok { background:#e3f1ec; color:#007a5e; }
        .cc-alert.err { background:#fce8e8; color:#b22222; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cc-page">

            <h1>Tax Classes</h1>
            <div class="cc-sub">
                India GST rate per tax class. Category par tax class set hoti hai, product me wahi auto-select hoti hai.
                Jab category ya product par kuch set na ho, <b>Default</b> class lagti hai.
            </div>

            @if (session('success'))<div class="cc-alert ok">{{ session('success') }}</div>@endif
            @if ($errors->any())
                <div class="cc-alert err">@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            @endif

            <form method="POST" action="{{ route('admin.tax-classes.update') }}" id="taxForm">
                @csrf

                <div class="cc-card">
                    <div class="cc-head"><h5>Tax Classes</h5></div>
                    <table class="cc-table">
                        <thead>
                        <tr><th>Name</th><th>GST %</th><th>Default</th><th>Used by</th><th></th></tr>
                        </thead>
                        <tbody>
                        @foreach ($classes as $c)
                            <tr>
                                <td><input type="text" name="classes[{{ $c->id }}][name]" value="{{ old("classes.$c->id.name", $c->name) }}" required></td>
                                <td><input type="number" step="0.01" min="0" max="100" name="classes[{{ $c->id }}][gst_rate]" value="{{ old("classes.$c->id.gst_rate", $c->gst_rate + 0) }}" required></td>
                                <td><input type="radio" name="default_class" value="{{ $c->id }}" @checked((int) old('default_class', $classes->firstWhere('is_default', true)?->id) === $c->id)></td>
                                <td>{{ $c->categories_count }} categories, {{ $c->products_count }} products</td>
                                <td>
                                    <button type="submit" form="del{{ $c->id }}" class="cc-btn danger"
                                        onclick="return confirm('Delete {{ addslashes($c->name) }}?')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td><input type="text" name="new[name]" value="{{ old('new.name') }}" placeholder="New class name (e.g. Saree)"></td>
                                <td><input type="number" step="0.01" min="0" max="100" name="new[gst_rate]" value="{{ old('new.gst_rate') }}" placeholder="GST %"></td>
                                <td colspan="3" style="color:#8c9196">Naya class add karne ke liye naam aur GST % bharo, phir Save</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="cc-note">
                        Rate badalne se sirf aage ke orders par asar padega. Purane orders me tax order ke time par save ho chuka hota hai.
                        Used wali class delete nahi hoti.
                    </div>
                </div>

                <div class="cc-bar">
                    <button type="submit" class="cc-btn primary"><i class="fa fa-save"></i> Save Tax Classes</button>
                </div>
            </form>

            {{-- delete forms (nested form nahi ho sakta, isliye bahar) --}}
            @foreach ($classes as $c)
                <form id="del{{ $c->id }}" method="POST" action="{{ route('admin.tax-classes.destroy', $c) }}">@csrf @method('DELETE')</form>
            @endforeach
        </div>
    </div>
</div>

@include('admin.footer')