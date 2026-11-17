@php
    $c = $category ?? null;
    $points = old('art_points', $c?->art_points ?? []);
    $points = is_array($points) ? array_values($points) : [];
@endphp

<style>
    .art-row { border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 12px; margin-bottom: 10px; background: #fafafa; }
    .art-row .field-group { margin-bottom: 10px; }
    .art-del { font-size: 12px; color: var(--red); background: none; border: none; cursor: pointer; padding: 0; }
    .art-add { font-size: 12.5px; color: var(--accent); background: none; border: 1px dashed var(--accent); border-radius: var(--radius-sm); padding: 7px 14px; cursor: pointer; }
</style>

<!-- Collection heading -->
<div class="section-card">
    <div class="section-card-header">
        <h5>Collection Heading (above product grid)</h5>
    </div>
    <div class="section-card-body">
        <div class="field-group">
            <label class="field-label">Eyebrow</label>
            <input type="text" name="collection_eyebrow" class="field-input" maxlength="100"
                value="{{ old('collection_eyebrow', $c?->collection_eyebrow) }}"
                placeholder="e.g. The Parijat Collection">
        </div>
        <div class="field-group">
            <label class="field-label">Heading</label>
            <input type="text" name="collection_title" class="field-input" maxlength="150"
                value="{{ old('collection_title', $c?->collection_title) }}"
                placeholder="e.g. Lamps Made to Be Lit and Loved.">
        </div>
        <div class="field-group">
            <label class="field-label">Text</label>
            <textarea name="collection_text" class="field-textarea" rows="3" maxlength="500"
                placeholder="One or two lines under the heading">{{ old('collection_text', $c?->collection_text) }}</textarea>
            <div class="field-hint">Leave heading and text blank to hide this block on the category page.</div>
        </div>
    </div>
</div>

<!-- Art of section -->
<div class="section-card">
    <div class="section-card-header">
        <h5>"Art Of" Section (below products)</h5>
    </div>
    <div class="section-card-body">
        <div class="field-group">
            <label class="field-label">Eyebrow</label>
            <input type="text" name="art_eyebrow" class="field-input" maxlength="100"
                value="{{ old('art_eyebrow', $c?->art_eyebrow) }}" placeholder="e.g. A TRADITION IN BRASS">
        </div>
        <div class="field-group">
            <label class="field-label">Heading</label>
            <input type="text" name="art_title" class="field-input" maxlength="150"
                value="{{ old('art_title', $c?->art_title) }}" placeholder="e.g. The Art of the Brass Diya">
        </div>
        <div class="field-group">
            <label class="field-label">Text</label>
            <textarea name="art_text" class="field-textarea" rows="3" maxlength="1000">{{ old('art_text', $c?->art_text) }}</textarea>
        </div>

        <div class="field-group">
            <label class="field-label">Points (max 6)</label>
            <div id="artPoints">
                @foreach ($points as $i => $pt)
                    <div class="art-row">
                        <div class="field-group">
                            <input type="text" name="art_points[{{ $i }}][title]" class="field-input"
                                maxlength="100" placeholder="Point title" value="{{ $pt['title'] ?? '' }}">
                        </div>
                        <div class="field-group">
                            <textarea name="art_points[{{ $i }}][text]" class="field-textarea" rows="2"
                                maxlength="300" placeholder="Short description">{{ $pt['text'] ?? '' }}</textarea>
                        </div>
                        <button type="button" class="art-del"><i class="fa fa-times"></i> Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" class="art-add" id="artAdd"><i class="fa fa-plus"></i> Add point</button>
        </div>

        <div class="field-group">
            <label class="field-label">Caption (on image)</label>
            <input type="text" name="art_caption" class="field-input" maxlength="100"
                value="{{ old('art_caption', $c?->art_caption) }}" placeholder="e.g. The Parijat Edit">
        </div>

        <div class="field-group">
            <label class="field-label">Image</label>
            @if ($c?->art_image)
                <div class="current-image-wrap" id="artCurrent" style="border:1px solid var(--border);border-radius:var(--radius-sm);padding:10px;background:var(--bg);margin-bottom:10px;display:flex;align-items:center;gap:12px">
                    <img src="{{ asset('storage/' . $c->art_image) }}" alt="" style="width:64px;height:64px;object-fit:cover;border-radius:8px">
                    <label style="font-size:12.5px;margin:0">
                        <input type="checkbox" name="remove_art_image" value="1"> Remove current image
                    </label>
                </div>
            @endif
            <input type="file" name="art_image" id="artImageInput" accept="image/*" class="field-input" style="height:auto;padding:8px">
            <div class="field-hint">PNG, JPG, WEBP, max 2 MB. Leave empty to show the section as text only.</div>
            <img id="artPreview" src="" alt="" style="display:none;max-width:160px;margin-top:10px;border-radius:8px;border:1px solid var(--border)">
        </div>

        <div class="field-hint">Leave heading and text blank to hide the whole section on the category page.</div>
    </div>
</div>

<template id="artPointTpl">
    <div class="art-row">
        <div class="field-group">
            <input type="text" name="art_points[__I__][title]" class="field-input" maxlength="100" placeholder="Point title">
        </div>
        <div class="field-group">
            <textarea name="art_points[__I__][text]" class="field-textarea" rows="2" maxlength="300" placeholder="Short description"></textarea>
        </div>
        <button type="button" class="art-del"><i class="fa fa-times"></i> Remove</button>
    </div>
</template>

<script>
    (function () {
        var wrap = document.getElementById('artPoints');
        var add = document.getElementById('artAdd');
        var tpl = document.getElementById('artPointTpl');
        var idx = {{ count($points) }} + 100; // unique keys, order is kept by DOM order
        var MAX = 6;

        add.addEventListener('click', function () {
            if (wrap.querySelectorAll('.art-row').length >= MAX) return;
            var html = tpl.innerHTML.replace(/__I__/g, idx++);
            wrap.insertAdjacentHTML('beforeend', html);
        });

        wrap.addEventListener('click', function (e) {
            var btn = e.target.closest('.art-del');
            if (btn) btn.closest('.art-row').remove();
        });

        document.getElementById('artImageInput').addEventListener('change', function () {
            var f = this.files[0], img = document.getElementById('artPreview');
            if (!f) { img.style.display = 'none'; return; }
            var r = new FileReader();
            r.onload = function (ev) { img.src = ev.target.result; img.style.display = 'block'; };
            r.readAsDataURL(f);
        });
    })();
</script>