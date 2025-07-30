@extends('admin.dashboard_layout')


@section('dashboard_body_content')
    <div class="content-wrapper">
        {{-- ----------------------------- EDIT CATEGORY FORM START ----------------------------- --}}
        <div class="col-md-7 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Type</h4>
                    <form class="forms-sample" method="POST"
                        action="{{ route('expenses_types/expense_type_update', $expenseType->slug) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">New Type Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('type') is-invalid @enderror"
                                    id="exampleInputUsername2" placeholder="Normal,pfs..." name="type"
                                    required value="{{ old('type', $expenseType->type) }}">
                                @error('type')
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
