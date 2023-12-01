@extends('layouts.vendor')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Products <span class="badge rounded-pill bg-danger">{{ count($data) }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('vendor.add.product') }}" class="btn btn-primary">Add Product</a>
                    {{--                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>--}}
                    {{--                    </button>--}}
                    {{--                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>--}}
                    {{--                        <a class="dropdown-item" href="javascript:;">Another action</a>--}}
                    {{--                        <a class="dropdown-item" href="javascript:;">Something else here</a>--}}
                    {{--                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Brands</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
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
                                <td>
                                    <img src="{{ asset($item->thumbnail) }}" style="width: 70px; height: 40px">
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>
                                    @if($item->discount == NULL)
                                        <span class="badge rounded-pill bg-info">No Discount</span>
                                    @else
                                        {{ (($item->price - $item->discount) / $item->price) * 100 }}
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('vendor.edit.product', $item->id) }}" class="btn btn-info" title="Edit Item"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('vendor.edit.product', $item->id) }}" class="btn btn-secondary" title="View Item"><i class="fa fa-eye"></i></a>
                                    @if($item->status == 1)
                                        <a href="{{ route('product.change.status', $item->id) }}" class="btn btn-warning" title="Deactivate Item"><i class="fa-solid fa-thumbs-down"></i></a>

                                    @else
                                        <a href="{{ route('vendor.product.change.status', $item->id) }}" class="btn btn-primary" title="Activate Item"><i class="fa-solid fa-thumbs-up"></i></a>

                                    @endif
                                    <a href="{{ route('vendor.delete.product', $item->id) }}" class="btn btn-danger" id="delete" title="Delete Item"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount</th>
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
