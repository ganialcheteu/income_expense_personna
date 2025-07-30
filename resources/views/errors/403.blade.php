@extends('errors.errorLayout')
@section('title', 'Access Denied Income | Expense')
@section('content')

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
                <div class="row flex-grow">
                    <div class="col-lg-7 mx-auto text-white">

                        <div class="m-4 p-4 rounded bg-danger">
                            {{-- error message --}}
                            <h2 class=" fs-3 fw-bold">{{$exception->getMessage()}}</h2>
                            {{-- error message --}}
                        </div>
                    </div>

                    <div class="col-lg-7 mx-auto text-white">
                        <div class="row align-items-center d-flex flex-row">
                            <div class="col-lg-6 text-lg-right pr-lg-4">
                                <h1 class="display-1 mb-0 animated">
                                    <span class="digit">4</span>
                                    <span class="digit">0</span>
                                    <span class="digit">3</span>
                                </h1>
                            </div>
                            <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                                <h2>Oops!</h2>
                                <h3 class="fw-light">Your can't access to this resource .Please log in save to continue.
                                </h3>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="login col-12 text-center mt-xl-2">
                                <a class="text-white" href="{{ route('login') }}">LOGIN</a>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 mt-xl-2 w-75 mx-auto">
                                <p class="text-white fw-medium text-center">Copyright &copy; 2025 All rights reserved.<br>
                                    Income | Expense</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
