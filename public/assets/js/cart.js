(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    function notify(type, title, text) {
        if (typeof window.showToast === 'function') return window.showToast(title, text, type);  // apna toast function
        if (type === 'error') alert(text || title);
    }

    function errorText(xhr) {
        var j = xhr.responseJSON || {};
        if (j.errors) return Object.values(j.errors)[0][0];
        return j.message || 'Something went wrong. Please try again.';
    }

    function call(url, method, payload) {
        return $.ajax({
            url: url, method: method, dataType: 'json',
            contentType: 'application/json', data: JSON.stringify(payload || {})
        });
    }

    // detail page ke main/sticky buttons detail ki selection bhejte hain, baaki (cards) sirf product id.
    // quantity nahi bhejte: server product ka minimum order qty khud lagata hai.
    function payloadFor($btn) {
        if ($btn.closest('.info-actions, .detail-sticky').length && typeof window.getCartPayload === 'function') {
            return window.getCartPayload();
        }
        return { product_id: $btn.data('id') };
    }

    function updateCartUI(res) {
        $('.cart-count').text(res.cart_count);
        $('.float-link[href*="/cart"] .f-count').text(res.cart_count);
        if (res.mini_cart_html) $('#miniCartBody').html(res.mini_cart_html);
    }

    // ── Add to cart ──
    $(document).on('click', '.js-add-cart', function (e) {
        e.preventDefault();
        var $btn = $(this);
        if ($btn.prop('disabled') || $btn.data('busy')) return;
        $btn.data('busy', true);

        call(window.APP.cartAdd, 'POST', payloadFor($btn))
            .done(function (res) {
                updateCartUI(res);
                if (res.coupon_message) notify('error', 'Coupon', res.coupon_message);
                notify('success', $btn.data('toast-title') || 'Added to Cart', $btn.data('toast-text') || res.message);
            })
            .fail(function (xhr) { notify('error', 'Could not add', errorText(xhr)); })
            .always(function () { $btn.data('busy', false); });
    });

    // ── Buy Now = add karo, phir checkout par bhejo ──
    $(document).on('click', '.js-buy-now', function (e) {
        e.preventDefault();
        var $btn = $(this), href = $btn.attr('href');
        if ($btn.hasClass('disabled') || $btn.data('busy')) return;
        $btn.data('busy', true);

        call(window.APP.cartAdd, 'POST', payloadFor($btn))
            .done(function () { window.location.href = href; })
            .fail(function (xhr) { $btn.data('busy', false); notify('error', 'Could not continue', errorText(xhr)); });
    });

    // ── Mini cart: quantity + / - ──
    $(document).on('click', '#miniCartBody .qty-plus, #miniCartBody .qty-minus', function () {
        var $b = $(this), $row = $b.closest('.cp-item');
        if ($row.data('busy')) return;
        $row.data('busy', true);

        call(window.APP.cartQty, 'POST', {
            item_id: $row.data('id'),
            action: $b.hasClass('qty-plus') ? 'plus' : 'minus'
        })
            .done(function (res) {
                updateCartUI(res);
                if (res.coupon_message) notify('error', 'Coupon', res.coupon_message);
            })
            .fail(function (xhr) { $row.data('busy', false); notify('error', 'Could not update', errorText(xhr)); });
    });

    // ── Mini cart: remove ──
    $(document).on('click', '#miniCartBody .cp-remove', function () {
        var $row = $(this).closest('.cp-item');
        if ($row.data('busy')) return;
        $row.data('busy', true);

        // agar tumhara remove route POST hai to 'DELETE' ko 'POST' kar do
        call(window.APP.cartRemove.replace(':id', $row.data('id')), 'DELETE')
            .done(function (res) {
                updateCartUI(res);
                if (res.coupon_message) notify('error', 'Coupon', res.coupon_message);
            })
            .fail(function (xhr) { $row.data('busy', false); notify('error', 'Could not remove', errorText(xhr)); });
    });
    
    window.cartUI = { notify: notify, errorText: errorText, updateCartUI: updateCartUI };

})(jQuery);