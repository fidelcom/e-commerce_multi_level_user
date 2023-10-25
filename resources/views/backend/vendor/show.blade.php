@extends('layouts.admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendor Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor Details</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('change.status', $data->id) }}">
                                    @csrf
                                    <input type="hidden" class="form-control" value="{{ $data->status }}" name="status" />
                                    <div class="row mb-3">
                                        <div class="col-sm-3">username
                                            <h6 class="mb-0">Vendor Username</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{ $data->username }}" name="username" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Shop Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" value="{{ $data->name }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="email" class="form-control" value="{{ $data->email }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="phone" class="form-control" value="{{ $data->phone }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control" value="{{ $data->address }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Join Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control" value="{{ $data->vendor_join }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Info</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="Vendor Info " rows="3">
                                                {{ $data->vendor_short_info }}
                                            </textarea>
                                        </div>
                                    </div>
{{--                                    <div class="row mb-3">--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <h6 class="mb-0">Photo</h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-9 text-secondary">--}}
{{--                                            <input type="file" name="photo" class="form-control" value="{{ $data->photo }}" id="image" />--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img src="{{ (!empty($data->photo)) ? asset('upload/vendor/profile/'.$data->photo) : asset('admin/assets/images/no_image.jpg') }}" alt="Admin" id="showImage" class="" style="width: 100px; height: 100px">
                                            {{--                                            <img src="https://flagcdn.com/w320/ck.png" alt="Admin" id="showImage" class="" style="width: 100px; height: 100px">--}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn {{ $data->status == 'inactive' ? 'btn-primary' : 'btn-danger' }} px-4" value="{{ $data->status == 'inactive' ? 'Make Active' : 'Make Inactive' }}" />
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
