@extends('admin.login_register_layout')
@section('title', 'Forgot Password Income | Expense')
@section('content')

    {{-- forgot password content start --}}
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-2 px-4 px-sm-5">

                            <div class="brand-logo">
                                <img src="{{ asset('/assets/images/codec_logo.png') }}" alt="logo">
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success mb-2 text-center">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mb-2 text-center">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            @if ($errors->has('error'))
                                <div class="alert alert-danger mb-2 text-center">
                                    {{ $errors->first('error') }}
                                </div>
                            @endif

                            <h4 class="text-center">Forgot your password? No problem. Just let us know your email address
                                and start process confidently.</h4>

                            <form class="pt-2" method="POST" action="{{ route('password.email') }}">

                                @csrf

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">
                                        Receive Reset Link <i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>

                            </form>

                            <div class="d-flex justify-content-between gap-1 my-3 text-center" style="font-size: 12px">
                                <span><a class="text-primary" href="{{ route('register') }}">Don't have an
                                        account?</a></span>
                                <span><a class="text-primary" href="{{ route('login') }}"> Remembered Password, Just
                                        Login?</a> </span>
                            </div>

                            <x-inc-exp-bottom-form></x-inc-exp-bottom-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- forgot password content end --}}

@endsection
