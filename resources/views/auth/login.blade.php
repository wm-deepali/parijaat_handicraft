@extends('layouts.admin-app')

@section('content')

    <style>
        /* Theme variables: poori login theme yahin se control hoti hai.
           --aw-primary ko site ke --primary ki hex se match kar lena. */
        :root {
            --aw-primary: #B08D57;
            --aw-primary-dark: #8F6F3F;
            --aw-bg: #FAF6EE;
            --aw-black: #0A0806;
            --aw-white: #FFFFFF;
            --aw-line: rgba(0, 0, 0, 0.12);
        }

        body {
            background: var(--aw-bg);
        }

        .login-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 950px;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            background: var(--aw-white);
        }

        .logo-box {
            background: var(--aw-white);
            padding: 15px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .logo-box img {
            width: 140px;
            height: auto;
            max-height: 90px;
            object-fit: contain;
        }

        .login-left {
            position: relative;
            width: 45%;
            background: linear-gradient(135deg, var(--aw-black), var(--aw-primary-dark));
            color: var(--aw-white);
            text-align: center;
            padding: 40px 20px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            inset: 16px;
            border: 1px solid rgba(255, 255, 255, 0.28);
            pointer-events: none;
        }

        .login-left h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 14px;
            opacity: 0.9;
        }

        .login-right {
            width: 55%;
            padding: 40px;
        }

        .login-title {
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--aw-black);
        }

        .login-right label {
            color: var(--aw-black);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            background: var(--aw-bg);
            border: 1px solid var(--aw-line);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(176, 141, 87, 0.18);
            border: 1px solid var(--aw-primary);
            background: var(--aw-white);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: none;
            background: var(--aw-primary);
            color: var(--aw-white);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--aw-primary-dark);
            color: var(--aw-white);
        }

        .form-check-label {
            font-size: 14px;
        }

        .form-check-input:checked {
            background-color: var(--aw-primary);
            border-color: var(--aw-primary);
        }

        .forgot-link {
            font-size: 14px;
            text-decoration: none;
            color: var(--aw-primary);
        }

        .forgot-link:hover {
            color: var(--aw-primary-dark);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                width: 100%;
            }

            .login-left {
                background: var(--aw-black);
            }
        }
    </style>

    @php
        $loginLogo = $general?->admin_login_logo;
        $siteName = $general?->site_name ?? 'Admin Panel';
        $tagline = $general?->tagline;
    @endphp

    <div class="login-wrapper">
        <div class="login-card">

            {{-- LEFT SIDE --}}
            <div class="login-left">

                <div class="logo-box">
                    <img src="{{ $loginLogo ? asset('storage/' . $loginLogo) : asset('assets/images/logo.png') }}"
                        alt="{{ $siteName }}">
                </div>

                <h2>{{ $siteName }}</h2>
                @if($tagline)
                    <p>{{ $tagline }}</p>
                @endif
            </div>

            {{-- RIGHT SIDE --}}
            <div class="login-right">
                <h4 class="login-title">Admin Login</h4>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus>

                        @error('email')
                            <span class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>

                        @error('password')
                            <span class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>
            </div>

        </div>
    </div>

@endsection