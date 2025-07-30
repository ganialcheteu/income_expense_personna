@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- CREATE CUSTOMER FORM START ----------------------------- --}}
    <div class="col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Customer</h4>
                <form class="forms-sample" method="POST" action="{{ route('customers/customer_store') }}">
                    @csrf
                    {{-- customer type  --}}
                    <div class="form-group row">
                        <div class="card p-1 col-11 mx-auto">
                            <select class="p-1 rounded-3 col-12 my-1 mx-auto" name="customer_type_id" id="customer_type_id">
                                <option disabled>Customer Type</option>
                                @foreach ($customer_types as $customer_type)
                                    <option value="{{ $customer_type->id }}">{{ $customer_type->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Name" value="{{ old('name') }}" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter Email" value="{{ old('email') }}" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="Enter Phone" value="{{ old('phone') }}" name="phone" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-sm-3 col-form-label">Country</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country"
                                placeholder="Enter Country" value="{{ old('country') }}" name="country" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                placeholder="Enter City" value="{{ old('city') }}" name="city" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                placeholder="Enter Address" value="{{ old('address') }}" name="address" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-info me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <x-go-back-button/>
    {{-- ----------------------------- CREATE CUSTOMER FORM START ----------------------------- --}}
@endsection
