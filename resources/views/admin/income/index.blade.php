@extends('admin.dashboard_layout')


<div class="content-wrapper">
    @section('dashboard_body_content')
        {{-- ------------------------------- ALL income START ------------------------------- --}}
        <!--incomes-->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
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
                        <h4 class="card-title">incomes</h4>

                        <x-only-super-admin :role="Auth::user()->role">

                            <p class="card-description">
                                <a href="{{ route('incomes/income_create') }}"
                                    class="badge badge-success text-decoration-none">
                                    + Add income</a>
                            </p>

                        </x-only-super-admin>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                    <th>Activity</th>
                                    <th>incomes Typ.</th>
                                    <th>incomes Cat.</th>
                                    <th>Customer</th>
                                    <th>Show</th>

                                    <x-only-super-admin :role="Auth::user()->role">

                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </x-only-super-admin>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($incomes as $income)
                                    <tr>
                                        <td>{{ $income->id }}</td>
                                        <td>{{ $income->name }}</td>
                                        <td>{{ $income->amount }}</td>
                                        <td>{{ $income->payment_date }}</td>
                                        {{-- Check if activity exists --}}
                                        <td>
                                            {{ $income->activity ? $income->activity->name : 'N/A' }}
                                        </td>
                                        <td>{{ $income->incomeType->type }}</td>
                                        <td>{{ $income->incomeCategory->category }}</td>
                                        <td>{{ $income->customer->name }}</td>
                                        <td><a href="{{ route('incomes/income_show', $income->slug) }}"
                                                class="badge badge-info text-decoration-none"><i
                                                    class="fa fa-eye me-1"></i>Show</a>
                                        </td>

                                        <x-only-super-admin :role="Auth::user()->role">

                                            <td>
                                                <a href="{{ route('incomes/income_edit', $income->slug) }}"
                                                    class="badge badge-info text-decoration-none"><i
                                                        class="fa fa-pencil me-1"></i>Edit</a>
                                            </td>

                                            <td>
                                                {{-- Button modal --}}
                                                <button class="badge badge-danger border-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $income->slug }}">
                                                    Delete
                                                </button>
                                            </td>
                                        </x-only-super-admin>

                                    </tr>

                                    {{-- Modal for this income --}}
                                    <x-only-super-admin :role="Auth::user()->role">

                                        <div class="modal fade" id="deleteModal-{{ $income->slug }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content text-center">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Delete income
                                                            {{ $income->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete
                                                        <h4 class="d-inline-block">{{ $income->name }} </h4> ?
                                                        <div>After this deletion, you will not able to recover this record.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form method="POST"
                                                            action="{{ route('incomes/income_destroy', $income->slug) }}">
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
                            {{ $incomes->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <x-go-back-button />
            </div>
        </div>

        {{-- ------------------------------- ALL income END ------------------------------- --}}
    @endsection
</div>
