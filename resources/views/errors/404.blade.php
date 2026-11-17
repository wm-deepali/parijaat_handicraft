@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')

    <main>
      <section class="comman-banner error-page">
        <div class="container">
          <div class="err-wrap">
            <span class="err-code" aria-hidden="true">404</span>

            <div class="err-content">
              <span class="status">Error 404</span>
              <h1>Page Not Found</h1>
              <p class="msg">
                The page you are looking for does not exist or has been moved.
              </p>

              <div class="btn-grp">
                <a href="{{ route('home') }}" class="btn btn-primary">
                  <i class="fa-solid fa-house" aria-hidden="true"></i> Go to
                  Home
                </a>
                <a href="product-listing.html" class="btn btn-outline-primary">
                  <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                  Browse Products
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection