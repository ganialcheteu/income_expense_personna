@extends('admin.dashboard_layout')


@section('dashboard_body_content')
    <div class="content-wrapper">
        {{-- ----------------------------- EDIT CATEGORY FORM START ----------------------------- --}}
        <div class="col-md-7 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <form class="forms-sample" method="POST"
                        action="{{ route('incomes_categories/income_category_update', $incomeCategory->slug) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">New Category Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                    id="exampleInputUsername2" placeholder="Hosting,Web_development..." name="category"
                                    required value="{{ old('category', $incomeCategory->category) }}">
                                @error('category')
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
        {{-- ----------------------------- EDIT CATEGORY FORM START ----------------------------- --}}
    </div>
<x-go-back-button/>
@endsection
