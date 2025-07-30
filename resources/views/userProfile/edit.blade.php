@extends('admin.dashboard_layout')

@section('dashboard_body_content')
    <div class="content-wrapper">
        {{-- ----------------------------- EDIT PROFILE FORM START ----------------------------- --}}
        <div class="d-flex flex-column align-items-center h-100">
            <div class="profileGrid">

                <div class="profileGridChild1">

                    <div class="myProfile">

                        <div>
                            <a class="nav-link p-2" id="UserDropdown" href="{{ route('profile.edit') }}"
                                data-bs-toggle="dropdown" aria-expanded="false">

                                {{-- active point --}}
                                <div class="img-profile">
                                    <x-active-user-circle active src width='8.5em' height='8.5em' />
                                </div>

                            </a>
                        </div>

                        <div class="profileInfo">
                            <div class="d-flex justify-content-between  align-items-baseline mx-auto gap-2">
                                <span class="fw-bold">Joined Us On: </span>
                                <span class="text-muted cursor-pointer"
                                    title="Joined on">{{ Auth::user()->created_at }}</span>
                            </div>
                            <div>
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                            </div>
                            <div>
                                <span class="fw-bold email"
                                    title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="profileGridChild2">
                    <div>
                        <div class="mx-auto p-4">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Profile Information') }}
                                    </h2>


                                    @if (session('success'))
                                        <div
                                            class="alert alert-success mb-2 p-2 text-success text-base text-center mx-auto">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __("Update your account's profile information and email address.") }}
                                    </p>
                                </header>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')

                                    <div class="w-100 mx-auto m-2">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" name="name" type="text"
                                            class="mt-1 block w-full form-control" :value="old('name', $user->name)" required
                                             />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div class="w-100 mx-auto m-2">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email"
                                            class="mt-1 block .
                                                                    full form-control"
                                            :value="old('email', $user->email)" required />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div>
                                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                                    {{ __('Your email address is unverified.') }}

                                                    <button form="send-verification"
                                                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                        {{ __('Click here to re-send the verification email.') }}
                                                    </button>
                                                </p>

                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                                        {{ __('A new verification link has been sent to your email address.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button class="btn btn-info" type="submit">Save</button>

                                        @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-success">
                                                {{ __('Saved.') }}
                                            </p>
                                        @endif
                                    </div>

                                </form>
                            </section>
                        </div>
                    </div>

                    <div class="d-flex flex-column align-items-center justify-content-between gap-3">
                        <img src="{{ asset('assets/images/codec_logo.png') }}" class="rounded-circle m-auto"
                            alt="CODEC logo">
                        <div>We Earn Money To Build Better Services !</div>
                        <div class="d-flex align-items-center justify-content-between gap-2 p-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <span class="mdi mdi-door-open">
                                        Log Out ?
                                    </span>
                                </button>
                            </form>
                            <x-go-back-button />
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- ----------------------------- EDIT PROFILE FORM START ----------------------------- --}}
    </div>
@endsection
