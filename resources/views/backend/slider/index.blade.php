@extends('layouts.admin')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Slider</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Slider</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('slider.create') }}" class="btn btn-primary">Add Slider</a>
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
        <h6 class="mb-0 text-uppercase">Slider</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Short Title</th>
                            <th>Slider Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->short_title }}</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" style="width: 70px; height: 40px">
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('slider.destroy', $item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Short Title</th>
                            <th>Slider Image</th>
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
