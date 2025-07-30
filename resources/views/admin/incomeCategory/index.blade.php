@extends('admin.dashboard_layout')


<div class="content-wrapper">
    @section('dashboard_body_content')
        {{-- ------------------------------- ALL INCOME CATEGORY START ------------------------------- --}}

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card resourcesIncomesCategories">
                <div class="card-body">

                    {{-- for succes message --}}

                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif

                    {{-- for succes fail --}}

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Incomes Categories</h4>
                        <x-only-super-admin :role="Auth::user()->role">

                            <p class="card-description">
                                <a href="{{ route('incomes_categories/income_category_create') }}"
                                    class="{{ Route::currentrouteName() === 'incomes_categories/income_category_create' ? 'active' : '' }} badge badge-success text-decoration-none">
                                    + Add Income Category</a>
                            </p>

                        </x-only-super-admin>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> ID</th>
                                    <th>Name</th>

                                    <x-only-super-admin :role="Auth::user()->role">

                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </x-only-super-admin>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($incomeCategories as $incomeCategory)
                                    <tr>
                                        <td>{{ $incomeCategory->id }}</td>
                                        <td>{{ $incomeCategory->category }}</td>

                                        <x-only-super-admin :role="Auth::user()->role">

                                            <td>
                                                <a href="{{ route('incomes_categories/income_category_edit', $incomeCategory->slug) }}"
                                                    class="{{ Route::currentrouteName() === 'incomes_categories/income_category_edit' ? 'active' : '' }} badge badge-info text-decoration-none"><i
                                                        class="fa fa-pencil me-1"></i>Edit</a>
                                            </td>

                                            <td>
                                                <!-- Button  modal -->
                                                <button class="badge badge-danger border-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $incomeCategory->slug }}">
                                                    Delete
                                                </button>
                                            </td>

                                    </tr>
                                    <!-- Modal for this income category -->
                                    <div class="modal fade" id="deleteModal-{{ $incomeCategory->slug }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-center">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Delete category
                                                        {{ $incomeCategory->category }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete income category
                                                    <h4 class="d-inline-block">{{ $incomeCategory->category }} </h4> ?
                                                    <div>After this deletion, you will not able to recover this record.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('incomes_categories/income_category_destroy', $incomeCategory->slug) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Yes,
                                                            Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </x-only-super-admin>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="border-top pt-2 pb-0">
                            {{-- pagination --}}
                            {{ $incomeCategories->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <x-go-back-button />
            </div>
        </div>

        {{-- ------------------------------- ALL INCOME CATEGORY END ------------------------------- --}}
    @endsection
</div>
