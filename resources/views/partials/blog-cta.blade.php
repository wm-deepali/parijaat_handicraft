{{-- resources/views/partials/blog-cta.blade.php --}}
@php $contact = \App\Models\Setting::contact(); @endphp
<div class="cta-box">
    <span class="cta-orb cta-orb-1" aria-hidden="true"></span>
    <span class="cta-orb cta-orb-2" aria-hidden="true"></span>
    <i class="fa-solid fa-handshake cta-mark" aria-hidden="true"></i>

    <div class="cta-left">
        <small class="eyebrow">READY TO SHOP?</small>
        <h3>Bring Home the Beauty of Handcrafted Brass.</h3>
        <p>
            Explore our collections, request a bulk quote or chat with our team. We're here to help you find the
            right pieces.
        </p>

        <div class="cta-btns">
            <a href="{{ route('products') }}" class="btn btn-white">
                Explore Collections <i class="fa-solid fa-arrow-right"></i>
            </a>
            @if($contact['whatsapp'])
                <a href="https://wa.me/{{ $contact['whatsapp'] }}" target="_blank" rel="noopener" class="btn cta-line">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
                </a>
            @endif
        </div>
    </div>

    <ul class="cta-actions">
        @if($contact['phone_link'])
            <li>
                <a href="tel:{{ $contact['phone_link'] }}" class="cta-action">
                    <span class="cta-action-ic"><i class="fa-solid fa-phone"></i></span>
                    <span class="cta-action-text">
                        <b>Call Our Team</b>
                        @if($contact['hours'])
                            <small>{{ $contact['hours'] }}</small>
                        @endif
                    </span>
                    <i class="fa-solid fa-arrow-right cta-action-go"></i>
                </a>
            </li>
        @endif
        <li>
            <button type="button" class="cta-action" data-model=".enquiry-pop">
                <span class="cta-action-ic"><i class="fa-solid fa-boxes-stacked"></i></span>
                <span class="cta-action-text">
                    <b>Request a Bulk Quote</b>
                    <small>Reply within 1–2 business days</small>
                </span>
                <i class="fa-solid fa-arrow-right cta-action-go"></i>
            </button>
        </li>
        @if($contact['email'])
            <li>
                <a href="mailto:{{ $contact['email'] }}" class="cta-action">
                    <span class="cta-action-ic"><i class="fa-solid fa-envelope"></i></span>
                    <span class="cta-action-text">
                        <b>Email Us</b>
                        <small>{{ $contact['email'] }}</small>
                    </span>
                    <i class="fa-solid fa-arrow-right cta-action-go"></i>
                </a>
            </li>
        @endif
    </ul>
</div>