@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- CREATE income FORM START ----------------------------- --}}
    <div class="col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit income</h4>

                <form class="forms-sample" method="POST" action="{{ route('incomes/income_update', $income->slug) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter income Name" value="{{ old('name', $income->name) }}" name="name"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                                placeholder="Enter income Amount in FRS CFA" name="amount"
                                value="{{ old('amount', $income->amount) }}" min="1" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="payment_date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                id="payment_date" placeholder="Enter income Date"
                                value="{{ old('payment_date', $income->payment_date) }}" name="payment_date" required>
                                @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- activity --}}
                    <div class="form-group row">
                        <div class="card p-1 col-11 mx-auto">
                            <select class="w-100 p-1 rounded-3 col-sm-12 my-1 mx-auto @error('activity_id') is-invalid @enderror"
                                name="activity_id" id="activity_id">
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}"
                                        {{ old('activity_id', $activity->id) == $activity->id ? 'selected' : '' }}>
                                        {{ $activity->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('activity_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- customer    --}}
                    <div class="form-group row">
                        <div class="card p-1 col-11 mx-auto">
                            <select class="w-100 p-1 rounded-3 col-sm-12 my-1 mx-auto @error('customer_id') is-invalid @enderror"
                                name="customer_id" id="customer_id">
                                <option disabled selected>customer Name</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id', $customer->id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- income type --}}
                    <div class="form-group row">
                        <div class="card p-1 col-11 mx-auto">
                            <select
                                class="w-100 p-1 rounded-3 col-sm-12 my-1 mx-auto @error('income_type_id') is-invalid @enderror"
                                name="income_type_id" id="income_type_id">
                                <option disabled selected>income Type</option>
                                @foreach ($incomeTypes as $incomeType)
                                    <option value="{{ $incomeType->id }}"
                                        {{ old('income_type_id', $incomeType->id) == $incomeType->id ? 'selected' : '' }}>
                                        {{ $incomeType->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('income_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- category type  --}}
                    <div class="form-group row">
                        <div class="card p-1 col-11 mx-auto">
                            <select
                                class="w-100 p-1 rounded-3 col-sm-12 my-1 mx-auto @error('income_category_id') is-invalid @enderror"
                                name="income_category_id" id="income_category_id">
                                <option disabled selected>Category Type</option>
                                @foreach ($incomeCategories as $incomeCategory)
                                    <option value="{{ $incomeCategory->id }}"
                                        {{ old('income_category_id', $incomeCategory->id) == $incomeCategory->id ? 'selected' : '' }}>
                                        {{ $incomeCategory->category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('income_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- images  --}}
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('image.*') is-invalid @enderror" id="image"
                                name="image[]" accept="image/*" multiple>
                            @error('image.*')
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
    <x-go-back-button />
    {{-- ----------------------------- CREATE income FORM END ----------------------------- --}}
@endsection
