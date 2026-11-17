@extends('layouts.app')

@section('title', 'Privacy Policy')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')
    <main>
        <section class="common-policies-secA">
            <div class="container-fluid">
                <div class="banner">
                    <nav class="breadcrumb" aria-label="Breadcrumb">
                        <ol>
                            <li>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>
                            <li aria-current="page">Privacy Policy</li>
                        </ol>
                    </nav>

                    <div class="heading">
                        <h1>Privacy Policy</h1>
                        <p>
                            How Parijaat Handicraft collects, uses and protects your
                            personal information.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="common-policies-secB">
            <div class="container-fluid">
                <div class="website-content">
                    <p><strong>Last updated:</strong> November 2026</p>

                    <h2>Overview</h2>
                    <p>
                        Parijaat Handicraft respects your privacy. This policy explains
                        what information we collect, how we use it, and the choices you
                        have. By using our website or placing an order, you agree to the
                        practices described here.
                    </p>

                    <h2>Information We Collect</h2>
                    <h3>Information You Provide</h3>
                    <ul>
                        <li>Name, email address and phone number.</li>
                        <li>Billing and shipping address.</li>
                        <li>Order details and purchase history.</li>
                        <li>Messages, enquiries and bulk quote requests you send to us.</li>
                        <li>Account details if you create an account.</li>
                    </ul>
                    <h3>Information Collected Automatically</h3>
                    <ul>
                        <li>IP address, browser type, device and operating system.</li>
                        <li>Pages visited, time spent and referring website.</li>
                        <li>Cookie and similar technology data.</li>
                    </ul>
                    <h3>Payment Information</h3>
                    <p>
                        Payments are processed by secure third-party payment providers. We
                        do not store your full card number, CVV or banking passwords on
                        our servers.
                    </p>

                    <h2>How We Use Your Information</h2>
                    <ul>
                        <li>To process, ship and deliver your orders.</li>
                        <li>
                            To send order confirmations, shipping updates and support
                            replies.
                        </li>
                        <li>To respond to enquiries and bulk quote requests.</li>
                        <li>To improve our website, products and customer experience.</li>
                        <li>
                            To send offers and updates, only where you have agreed to
                            receive them.
                        </li>
                        <li>To prevent fraud and protect the security of our website.</li>
                        <li>To meet our legal and tax obligations.</li>
                    </ul>

                    <h2>Sharing Your Information</h2>
                    <p>
                        We do not sell your personal information. We share it only with
                        trusted parties who help us run our business:
                    </p>
                    <ul>
                        <li>
                            Courier and logistics partners, to deliver your order, including
                            international carriers.
                        </li>
                        <li>Payment gateways, to process your payment securely.</li>
                        <li>Technology providers for hosting, analytics and email services.</li>
                        <li>
                            Authorities, where required by law or to protect our legal
                            rights.
                        </li>
                    </ul>

                    <h2>International Transfers</h2>
                    <p>
                        We are based in India and serve customers worldwide. Your
                        information may be processed and stored in India or in other
                        countries where our service providers operate. We take reasonable
                        steps to protect your information wherever it is processed.
                    </p>

                    <h2>Cookies</h2>
                    <p>
                        We use cookies to keep your cart working, remember your
                        preferences and understand how visitors use our website. You can
                        control or disable cookies in your browser settings. Disabling
                        some cookies may affect how the website works.
                    </p>

                    <h2>Data Retention</h2>
                    <p>
                        We keep your information only as long as needed to fulfil orders,
                        provide support, and meet legal, accounting and tax requirements.
                        After that, it is deleted or anonymised.
                    </p>

                    <h2>Data Security</h2>
                    <p>
                        We use reasonable technical and organisational measures to protect
                        your information from unauthorised access, loss or misuse.
                        However, no online system can be guaranteed to be completely
                        secure.
                    </p>

                    <h2>Your Rights</h2>
                    <p>Depending on where you live, you may have the right to:</p>
                    <ul>
                        <li>Access the personal information we hold about you.</li>
                        <li>Correct inaccurate or incomplete information.</li>
                        <li>Request deletion of your information.</li>
                        <li>Withdraw consent for marketing communications.</li>
                        <li>
                            Object to or restrict certain types of processing, where
                            applicable.
                        </li>
                    </ul>
                    <p>
                        To exercise any of these rights, please contact us using the
                        details below. We may need to verify your identity before acting
                        on a request.
                    </p>

                    <h2>Marketing Communications</h2>
                    <p>
                        If you subscribe to our emails or messages, you can unsubscribe at
                        any time using the link in the message or by contacting us.
                        Order-related messages will still be sent.
                    </p>

                    <h2>Children's Privacy</h2>
                    <p>
                        Our website is not intended for children under 18. We do not
                        knowingly collect personal information from children. If you
                        believe a child has shared information with us, please contact us
                        and we will delete it.
                    </p>

                    <h2>Third-Party Links</h2>
                    <p>
                        Our website may contain links to other websites, including our
                        Amazon store. We are not responsible for the privacy practices of
                        those websites. Please read their policies before sharing your
                        information.
                    </p>

                    <h2>Changes to This Policy</h2>
                    <p>
                        We may update this policy from time to time. Changes will be
                        posted on this page with a new "Last updated" date.
                    </p>

                    <h2>Contact Us</h2>
                    <p>For privacy questions or requests, please contact us:</p>
                    <ul>
                        <li>
                            <strong>Email:</strong>
                            <a href="mailto:info@parijaathandicraft.com">info@parijaathandicraft.com</a>
                        </li>
                        <li>
                            <strong>Phone:</strong>
                            <a href="tel:+910000000000">+91 00000 00000</a>
                        </li>
                        <li>
                            <strong>Hours:</strong> Monday to Saturday, 10:00 AM – 7:00 PM
                        </li>
                    </ul>
                    {{-- DEV NOTE: Confirm which analytics/cookie tools and payment gateway are actually used, and update the sections above accordingly. --}}
                </div>
            </div>
        </section>
    </main>
@endsection