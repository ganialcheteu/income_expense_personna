@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- CREATE Expense FORM START ----------------------------- --}}
    <!--expenses-->
    <div class="col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Expense</h4>

                <form class="forms-sample" method="POST" action="{{ route('expenses/expense_update', $expense->slug) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Expense Name" value="{{ old('name', $expense->name) }}" name="name"
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
                                placeholder="Enter Expense Amount in Frs CFA" name="amount"
                                value="{{ old('amount', $expense->amount) }}" min="1" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="payment_date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror"
                                id="payment_date" placeholder="Enter Expense Date"
                                value="{{ old('payment_date', $expense->payment_date) }}" name="payment_date" required>
                            @error('payment_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- activity --}}
                    <div class="form-group row">
                        <div class="card p-1 col-lg-12 col-xl-12 mx-auto">
                            <select class="p-1 rounded-3 col-11 my-1 mx-auto @error('activity_id') is-invalid @enderror"
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
                    {{-- supplier    --}}
                    <div class="form-group row">
                        <div class="card p-1 col-lg-12 col-xl-12 mx-auto">
                            <select class="p-1 rounded-3 col-11 my-1 mx-auto @error('supplier_id') is-invalid @enderror"
                                name="supplier_id" id="supplier_id">
                                <option disabled selected>Supplier Name</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ old('supplier_id', $supplier->id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- expense type --}}
                    <div class="form-group row">
                        <div class="card p-1 col-lg-12 col-xl-12 mx-auto">
                            <select
                                class="p-1 rounded-3 col-11 my-1 mx-auto @error('expense_type_id') is-invalid @enderror"
                                name="expense_type_id" id="expense_type_id">
                                <option disabled selected>Expense Type</option>
                                @foreach ($expenseTypes as $expenseType)
                                    <option value="{{ $expenseType->id }}"
                                        {{ old('expense_type_id', $expenseType->id) == $expenseType->id ? 'selected' : '' }}>
                                        {{ $expenseType->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expense_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- category type  --}}
                    <div class="form-group row">
                        <div class="card p-1 col-lg-12 col-xl-12 mx-auto">
                            <select
                                class="p-1 rounded-3 col-11 my-1 mx-auto @error('expense_category_id') is-invalid @enderror"
                                name="expense_category_id" id="expense_category_id">
                                <option disabled selected>Category Type</option>
                                @foreach ($expenseCategories as $expenseCategory)
                                    <option value="{{ $expenseCategory->id }}"
                                        {{ old('expense_category_id', $expenseCategory->id) == $expenseCategory->id ? 'selected' : '' }}>
                                        {{ $expenseCategory->category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expense_category_id')
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
    {{-- ----------------------------- CREATE Expense FORM END ----------------------------- --}}
@endsection
