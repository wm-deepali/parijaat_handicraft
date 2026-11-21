@extends('layouts.app')

@section('title', $page->meta_title ?: $page->heading)
@section('meta_description', $page->meta_description)

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
                            <li aria-current="page">{{ $page->heading }}</li>
                        </ol>
                    </nav>

                    <div class="heading">
                        <h1>{{ $page->heading }}</h1>
                        @if($page->short_description)
                            <p>{{ $page->short_description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="common-policies-secB">
            <div class="container-fluid">
                <div class="website-content">
                    @if($page->updated_at)
                        <p><strong>Last updated:</strong> {{ $page->updated_at->format('F Y') }}</p>
                    @endif

                    {!! $content !!}
                </div>
            </div>
        </section>
    </main>
@endsection