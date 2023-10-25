@extends('layouts.admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr/>
                <form id="myForm" method="POST" action="{{ route('update.product', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="name" class="form-control" id="inputProductTitle" value="{{ $product->name }}" placeholder="Enter product name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_description" id="inputProductDescription" rows="3">
                                            {{ $product->short_description }}
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="texteditor" class="form-label">Long Description</label>
                                        <textarea class="form-control" name="long_description" id="texteditor" rows="3">
                                            {!! $product->long_description !!}
                                        </textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputProductTags" class="form-label">Product Tags</label>
                                        <input type="text" name="tags" class="form-control visually-hidden" data-role="tagsinput" id="inputProductTags" value="{{ $product->tags }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="size" class="form-label">Product Size</label>
                                        <input type="text" name="size" class="form-control visually-hidden" data-role="tagsinput" id="size" value="{{ $product->size }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="color" class="form-label">Product Color</label>
                                        <input type="text" name="color" class="form-control visually-hidden" data-role="tagsinput" id="color" value="{{ $product->color }}">
                                    </div>
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="inputProductDescription" class="form-label">Main Product Image</label>--}}
{{--                                        <input class="form-control" name="thumbnail" type="file" id="formFile" onchange="mainThamUrl(this)">--}}
{{--                                        <img src="" id="#mainThmb">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <label for="inputProductDescription" class="form-label">Other Product Images</label>--}}
{{--                                        --}}{{--                                        <input id="image-uploadify" name="multi_image[]" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>--}}
{{--                                        <input class="form-control" name="multi_image[]" type="file" id="formFile" multiple>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="inputPrice" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control" id="inputPrice" value="{{ $product->price }}" placeholder="00.00">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCostPerPrice" class="form-label">Discount</label>
                                            <input type="number" name="discount" class="form-control" id="inputCostPerPrice" value="{{ $product->discount }}" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="code" class="form-control" id="inputCostPerPrice" value="{{ $product->code }}" placeholder="00.00">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputCostPerPrice" class="form-label">Product Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="inputCostPerPrice" value="{{ $product->quantity }}" placeholder="00.00">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select class="form-select" name="brand_id" id="inputProductType">
                                                <option></option>
                                                @foreach($brand as $item)
                                                    <option value="{{ $item->id }}" {{ $product->brand_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select class="form-select" name="product_category_id" id="inputVendor">
                                                <option></option>
                                                @foreach($category as $item)
                                                    <option value="{{ $item->id }}" {{ $product->product_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Product Subcategory</label>
                                            <select class="form-select" name="product_subcategory_id" id="inputCollection">
                                                <option></option>
                                                @foreach($subcategory as $item)
                                                    <option value="{{ $item->id }}" {{ $product->product_subcategory_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select class="form-select" name="user_id" id="inputCollection">
                                                <option></option>
                                                @foreach($vendor as $item)
                                                    <option value="{{ $item->id }}" {{ $product->user_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="hot_deals" {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hot_deals">Hot Deals</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="featured" type="checkbox" value="1" id="featured" {{ $product->featured == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured">Featured</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="special_offer" {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="special_offer">Special Offer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals" {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="special_deals">Special Deals</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </form>
            </div>
        </div>
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Main Product Image</h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('update.product.thumbnail', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Chose Product Image</label>
                            <input class="form-control" name="thumbnail" type="file" id="thumbnail">
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label"></label>
                            <img src="{{ asset($product->thumbnail) }}" id="#mainThmb" width="100" height="100">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Image</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="d-flex justify-content-between">
                <h6 class="mb-0 text-uppercase">Update Other Product Image</h6>
                <form method="POST" action="{{ route('add.product.multi.image', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="multi_image[]" class="form-control"   id="formFile" multiple required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Add product multi Image</button>
                        </div>
                    </div>

                </form>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 table-striped">
                        <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form method="POST" action="{{ route('update.product.multi.image', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @foreach($product->multiImage as $key => $image)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td><img src="{{ asset($image->name) }}" width="70" height="40"></td>
                                    <td>
                                        <input type="file" name="multi_image[{{ $image->id }}]" class="form-control"   id="formFile">
                                        <input type="hidden" class="form-control" name="id" value="{{ $image->id }}">
                                    </td>

                                    <td>
                                        <button type="submit" class="btn btn-primary">Update Image</button>
                                        <a href="{{ route('delete.product.multi.image', $image->id) }}" id="delete" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },
                    short_description: {
                        required : true,
                    },
                    thumbnail: {
                        required : true,
                    },
                    multi_image: {
                        required : true,
                    },
                    price: {
                        required : true,
                    },
                    code: {
                        required : true,
                    },
                    quantity: {
                        required : true,
                    },
                    brand_id: {
                        required : true,
                    },
                    product_category_id: {
                        required : true,
                    },
                    product_subcategory_id: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Product Name',
                    },
                    short_description: {
                        required : 'Please Enter Short Description',
                    },
                    thumbnail: {
                        required : 'Please Select Product Thambnail Image',
                    },
                    multi_image: {
                        required : 'Please Select Product Multi Image',
                    },
                    price: {
                        required : 'Please Enter Selling Price',
                    },
                    code: {
                        required : 'Please Enter Product Code',
                    },
                    quantity: {
                        required : 'Please Enter Product Quantity',
                    },

                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>

    <script type="text/javascript">
        function mainThamUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function (){
            $('select[name="product_category_id"]').on('change', function (){
                let product_category_id = $(this).val();
                if (product_category_id)
                {
                    $.ajax({
                        url: "{{ url('/product/subcategory/show') }}/"+product_category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data){
                            $('select[name="product_subcategory_id"]').html('');
                            let d = $('select[name="product_subcategory_id"]').empty();
                            $.each(data, function (key, value){
                                $('select[name="product_subcategory_id"]').append('<option value="'+value.id+'" >' + value.name + '</option>')
                            })
                        }
                    })
                } else {
                    alert('danger');
                }
            })
        })
    </script>
@endsection
