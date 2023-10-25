@extends('layouts.admin')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Active Vendors</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Active Vendors</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Active Vendor</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Shop Name</th>
                            <th>Vendor Username</th>
                            <th>Vendor Email</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>{{ $item->vendor_join }}</td>
                                <td><span class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}">{{ $item->status }}</span></td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('view.vendor', $item->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('delete.product.subcategory', $item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Shop Name</th>
                            <th>Vendor Username</th>
                            <th>Vendor Email</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
