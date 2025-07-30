@extends('admin.login_register_layout')
@section('title', 'Register Income | Expense')
@section('content')

    {{-- register content start --}}

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="register row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-2 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/codec_logo.png') }}" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                            <form id="registerForm" class="pt-2" action="{{ route('register') }}" method="POST" novalidate>
                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                                        placeholder="Your Name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div id="error-name" class="error invalid-feedback text-danger">{{ $message }}
                                        </div>
                                    @enderror
                                    <div id="errorName"></div>
                                </div>

                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email')is-invalid @enderror" id="email"
                                        placeholder="Your Email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="error invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="errorEmail"></div>
                                </div>

                                <div class="form-group">
                                    <select class="form-select form-select-lg @error('role') is-invalid @enderror"
                                        name="role" id="role">
                                        {{-- role --}}
                                        <?php
    $superAdmin = \App\Models\User::where('role', 'super_admin')->exists();
    $optionAdmin = "<option value=\"admin\" selected>Admin</option>";
    $optionSuperAdmin =
        "<option value=\"super_admin\" disabled>Super Admin</option>";
    if ($superAdmin) {
        echo htmlspecialchars($optionAdmin, ENT_QUOTES, 'UTF-8');
        echo htmlspecialchars($optionSuperAdmin, ENT_QUOTES, 'UTF-8');
    } else {
        echo "<option value=\"admin\" selected>Admin</option>";
        echo "<option value=\"super_admin\">Super Admin</option>";
    }
                                            ?>
                                    </select>
                                    @error('role')
                                        <div class="error invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="errorRole"></div>
                                </div>

                                <div class="form-group position-relative">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password')is-invalid @enderror"
                                        id="password" placeholder="Password" name="password">
                                    @error('password')
                                        <div class="error invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="errorPassword"></div>
                                    <img id="eyeIcon" src="{{ asset('assets/images/eyeon.png') }}"
                                        class="position-absolute mx-2"
                                        style="transform: translateY(-50%);cursor:pointer;width:15px;height:15px; top:50%;right:9px;z-index:2;">
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted" id="checkboxLabel">
                                                <input type="checkbox" class="form-check-input" id="checkbox"> I agree to
                                                all Terms &
                                                Conditions </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">
                                        Sign Up <i class="fas fa-sign-in-alt ml-1"></i>
                                    </button>
                                </div>

                                <div class="text-center mt-4 fw-light"> Already have an account? <a
                                        href="{{ route('login') }}" class="text-primary">Sign In</a>
                                </div>
                            </form>
                            <x-inc-exp-bottom-form></x-inc-exp-bottom-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- register content end --}}


@endsection
