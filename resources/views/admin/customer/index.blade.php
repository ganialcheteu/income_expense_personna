@extends('admin.dashboard_layout')


<div class="content-wrapper">
    @section('dashboard_body_content')
        {{-- ------------------------------- ALL customer START ------------------------------- --}}
        <!--customers-->
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
                        <h4 class="card-title">customers</h4>

                        <x-only-super-admin :role="Auth::user()->role">

                            <p class="card-description">
                                <a href="{{ route('customers/customer_create') }}"
                                    class="badge badge-success text-decoration-none">
                                    + Add customer</a>
                            </p>

                        </x-only-super-admin>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th>Customer Type</th>

                                    <x-only-super-admin :role="Auth::user()->role">

                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </x-only-super-admin>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->country }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->customerType->type }}</td>

                                        <x-only-super-admin :role="Auth::user()->role">


                                            <td>
                                                <a href="{{ route('customers/customer_edit', $customer->slug) }}"
                                                    class="badge badge-info text-decoration-none"><i
                                                        class="fa fa-pencil me-1"></i>Edit</a>
                                            </td>

                                            <td>
                                                {{-- Button modal --}}
                                                <button class="badge badge-danger border-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $customer->slug }}">
                                                    Delete
                                                </button>
                                            </td>

                                    </tr>
                                    {{-- Modal for this supplier --}}
                                    <div class="modal fade" id="deleteModal-{{ $customer->slug }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-center">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Delete Customer
                                                        {{ $customer->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete customer
                                                    <h4 class="d-inline-block">{{ $customer->name }} </h4> ?
                                                    <div>After this deletion, you will not able to recover this record.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('customers/customer_destroy', $customer->slug) }}">
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
                            {{ $customers->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <x-go-back-button />
            </div>
        </div>

        {{-- ------------------------------- ALL customer END ------------------------------- --}}
    @endsection
</div>
