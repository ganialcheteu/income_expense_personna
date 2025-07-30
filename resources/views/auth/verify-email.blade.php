@extends('errors.errorLayout')
@section('title', 'Verify Email Income | Expense')
@section('content')

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper verifyLeak">
            <div class="verify_email my-auto content-wrapper text-center error-page bg-primary w-50">

                <div class="text-center text-white fw-bold fs-4 mb-4">
                    <h4>Verify Your Email Address !</h4>
                </div>

                <div class="verify_email_control">
                    <div>
                        <img src="{{ asset('/assets/images/logo-codec-mini.png') }}" class="logoVerify" alt="logo" />
                    </div>
                    <div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-3 text-success fw-bold">
                                {{ __('New verification link has been sent to your email') }}
                            </div>
                        @endif

                        <div class="d-flex flex-column align-items-center justify-content-between gap-2">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button class="login btn btn-primary">
                                        {{ __('Resend Link') }}
                                    </button>
                                </div>
                            </form>
                            <span class="my-2">-- Or --</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="login btn btn-primary">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection
