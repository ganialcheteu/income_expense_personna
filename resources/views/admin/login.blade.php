@extends('admin.login_register_layout')
@section('title', 'Login Income | Expense')
@section('content')
    {{-- login content start --}}

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-2 px-4 px-sm-5 w-100 mx-auto" style=max-width:400px;>
                            <div class="brand-logo">
                                <img src="{{ asset('/assets/images/codec_logo.png') }}" alt="logo">
                            </div>

                            {{-- error message for access denied --}}

                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                            @endif

                            {{-- error message for access denied --}}


                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            <form id="loginForm" class="pt-2" method="POST" action="{{ route('login') }}" novalidate>
                                @csrf

                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Your Email" value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="errorEmail"></div>
                                </div>

                                <div class="form-group position-relative">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Your Password" required>
                                    @error('password')
                                        <div class="error invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="errorPassword"></div>
                                    <img id="eyeIcon" src="{{ asset('assets/images/eyeon.png') }}"
                                        class="position-absolute mx-2"
                                        style="transform: translateY(-50%);cursor:pointer;width:15px;height:15px; top:50%;right:9px;z-index:2;">
                                </div>

                                <div class="form-group mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">
                                        Sign In <i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember"> Keep me signed
                                            in
                                        </label>
                                    </div>
                                    <a href="{{ route('password.request') }}"
                                        class="auth-link text-black text-primary">Forgot
                                        password?
                                    </a>
                                </div>
                                <div class="my-2">
                                    <div class="text-center mt-4 fw-light"> Don't have an account? <a
                                            href="{{ route('register') }}" class="text-primary">Sign Up</a>
                                    </div>
                                </div>
                            </form>
                            <x-inc-exp-bottom-form></x-inc-exp-bottom-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- login content end --}}
@endsection
