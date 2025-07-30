@extends('admin.dashboard_layout')


<div class="content-wrapper">


    @section('dashboard_body_content')
        {{-- ------------------------------- ALL SUPPLIER START ------------------------------- --}}


        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    {{-- for succes message --}}

                    @if (session('info'))
                        <div class="alert alert-success">
                            {{ session('info') }}
                        </div>
                    @endif

                    {{-- for fail message --}}

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Suppliers</h4>
                        <x-only-super-admin :role="Auth::user()->role">

                            <p class="card-description">
                                <a href="{{ route('suppliers/supplier_create') }}"
                                    class="badge badge-success text-decoration-none">
                                    + Add Supplier</a>
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
                                    <x-only-super-admin :role="Auth::user()->role">

                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </x-only-super-admin>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->country }}</td>
                                        <td>{{ $supplier->city }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <x-only-super-admin :role="Auth::user()->role">
                                            <td>
                                                <a href="{{ route('suppliers/supplier_edit', $supplier->slug) }}"
                                                    class="badge badge-info text-decoration-none"><i
                                                        class="fa fa-pencil me-1"></i>Edit</a>
                                            </td>

                                            <td>
                                                {{-- Button modal --}}
                                                <button class="badge badge-danger border-0" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $supplier->slug }}">
                                                    Delete
                                                </button>
                                            </td>
                                    </tr>

                                    {{-- Modal for this supplier --}}
                                    <div class="modal fade" id="deleteModal-{{ $supplier->slug }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-center">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Delete Supplier
                                                        {{ $supplier->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete
                                                    <h4 class="d-inline-block">{{ $supplier->name }} </h4> ?
                                                    <div>After this deletion, you will not able to recover this record.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('suppliers/supplier_destroy', $supplier->slug) }}">
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
                            {{ $suppliers->links('vendor.pagination.bootstrap-5') }}
                        </div>

                    </div>
                </div>
                <x-go-back-button />
            </div>
        </div>
        {{-- ------------------------------- ALL SUPPLIER END ------------------------------- --}}
    @endsection
</div>
