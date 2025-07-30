@extends('admin.dashboard_layout')
@section('dashboard_body_content')
    {{-- ----------------------------- EDIT ACTIVITY FORM START ----------------------------- --}}
    <div class="col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Activity</h4>
                <form class="forms-sample" method="POST" action="{{ route('activities/activity_update', $activity->slug) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter Activity Name" value="{{ old('name', $activity->name) }}" name="name"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                placeholder="Enter Activity Description" name="description" required>{{ old('description', $activity->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control @error('image.*') is-invalid @enderror" id="image"
                                name="image[]" accept="image/*" value="{{ old('image[]', $activity->images) }}" multiple>
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
    {{-- ----------------------------- EDIT ACTIVITY FORM START ----------------------------- --}}
@endsection
