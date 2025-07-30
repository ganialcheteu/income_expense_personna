@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- CREATE type FORM START ----------------------------- --}}
    <div class="col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Type</h4>
                <form class="forms-sample" method="POST" action="{{ route('incomes_types/income_type_store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Type Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('type') is-invalid @enderror"
                                id="exampleInputUsername2" placeholder="Normal,pfs ..." name="type" value="{{ old('type') }}"
                                required>
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
    <x-go-back-button/>
    {{-- ----------------------------- CREATE type FORM START ----------------------------- --}}
@endsection
