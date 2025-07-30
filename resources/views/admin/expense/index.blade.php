@extends('admin.dashboard_layout')


<div class="content-wrapper">
    @section('dashboard_body_content')
        {{-- ------------------------------- ALL expense START ------------------------------- --}}
        <!--expenses-->
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
                        <h4 class="card-title">expenses</h4>

                        <x-only-super-admin :role="Auth::user()->role">

                            <p class="card-description">
                                <a href="{{ route('expenses/expense_create') }}"
                                    class="badge badge-success text-decoration-none">
                                    + Add expense</a>
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
                                    <th>Expenses Typ.</th>
                                    <th>Expenses Cat.</th>
                                    <th>Supplier</th>
                                    <th>Image</th>

                                    <x-only-super-admin :role="Auth::user()->role">

                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </x-only-super-admin>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->id }}</td>
                                        <td>{{ $expense->name }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->payment_date }}</td>
                                        {{-- Check if activity exists --}}
                                        <td>
                                            {{ $expense->activity ? $expense->activity->name : 'N/A' }}
                                        </td>
                                        <td>{{ $expense->expenseType->type }}</td>
                                        <td>{{ $expense->expenseCategory->category }}</td>
                                        <td>{{ $expense->supplier->name }}</td>
                                        <td><a href="{{ route('expenses/expense_show', $expense->slug) }}"
                                                class="badge badge-info text-decoration-none"><i
                                                    class="fa fa-eye me-1"></i>Image</a>
                                        </td>

                                        <x-only-super-admin :role="Auth::user()->role">

                                            <td>
                                                <a href="{{ route('expenses/expense_edit', $expense->slug) }}"
                                                    class="badge badge-info text-decoration-none"><i
                                                        class="fa fa-pencil me-1"></i>Edit</a>
                                            </td>

                                            <td>
                                                {{-- Button modal --}}
                                                <button class="badge badge-danger border-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $expense->slug }}">
                                                    Delete
                                                </button>
                                            </td>

                                    </tr>
                                    {{-- Modal for this expense --}}
                                    <div class="modal fade" id="deleteModal-{{ $expense->slug }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-center">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Delete expense
                                                        {{ $expense->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete
                                                    <h4 class="d-inline-block">{{ $expense->name }} </h4> ?
                                                    <div>After this deletion, you will not able to recover this record.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('expenses/expense_destroy', $expense->slug) }}">
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
                            {{ $expenses->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <x-go-back-button />
            </div>
        </div>

        {{-- ------------------------------- ALL expense END ------------------------------- --}}
    @endsection
</div>
