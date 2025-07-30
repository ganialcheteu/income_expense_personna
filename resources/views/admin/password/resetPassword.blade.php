@extends('admin.login_register_layout')
@section('title', 'Forgot Password Income | Expense')
@section('content')

    {{-- reset password content start --}}

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-2 px-4 px-sm-5">

                            <div class="brand-logo">
                                <img src="{{ asset('/assets/images/codec_logo.png') }}" alt="logo">
                            </div>

                            @if ($errors->has('error'))
                                <div class="alert alert-danger mb-2 text-center">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif

                            <h4>Hello! let's Reset Your Password</h4>

                            <form class="pt-2" method="POST" action="{{ route('password.store') }}">

                                @csrf

                                {{-- Password Reset Token --}}
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        id="exampleInputEmail1" name="email" placeholder="Your Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" name="password" placeholder="Your Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        id="exampleInputPassword1" name="password_confirmation"
                                        placeholder="Confirm Your Password" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">
                                        Receive Reset Link <i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>

                            </form>

                            <x-inc-exp-bottom-form></x-inc-exp-bottom-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- reset password content end --}}

@endsection
