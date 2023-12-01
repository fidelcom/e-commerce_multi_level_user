<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach($categories = \App\Models\ProductCategory::orderBy('name', 'ASC')->get() as $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $category->id }}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">
                            {{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        @php
            $products = \App\Models\Product::where('status', 1)->orderBy('id', 'ASC')->limit(10)->get();
        @endphp
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->slug) }}">
                                        <img class="default-img" src="{{ asset($product->thumbnail) }}" alt="" />
                                        <img class="hover-img" src="{{ asset($product->thumbnail) }}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                @php
                                    $discount = (($product->price - $product->discount)/ $product->price) * 100;
                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($product->discount == NULL)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif

                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{ url('product/category/'.$product->product_category_id.'/'.$product->product_category->slug) }}">{{ $product->product_category->name }}</a>
                                </div>
                                <h2><a href="{{  url('product/details/'.$product->id.'/'.$product->slug) }}">{{ $product->name }}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="{{ route('vendor.details', $product->id) }}">{{ $product->user->name }}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    @if($product->discount == NULL)
                                        <div class="product-price">
                                            <span>${{ $product->price }}</span>
{{--                                            <span class="old-price">$32.8</span>--}}
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $product->discount }}</span>
                                            <span class="old-price">${{ $product->price }}</span>
                                        </div>
                                    @endif

                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach($categories as $category)
            <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="tab-two">
                <div class="row product-grid-4">
                    @forelse($category->product as $prod)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{  url('product/details/'.$product->id.'/'.$product->slug) }}">
                                            <img class="default-img" src="{{ asset($prod->thumbnail) }}" alt="" />
                                            <img class="hover-img" src="{{ asset($prod->thumbnail) }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    @php
                                        $disc = (($prod->price - $prod->discount)/ $prod->price) * 100;
                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="{{ $prod->discount == NULL ? 'new' : 'hot' }}">{{ $prod->discount == NULL ? 'NEW' : round($disc) }}</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $prod->product_category->name }}</a>
                                    </div>
                                    <h2><a href="{{  url('product/details/'.$product->id.'/'.$product->slug) }}">{{ $prod->name }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">{{ $prod->user->name }}</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        @if($prod->discount == NULL)
                                            <div class="product-price">
                                                <span>${{ $prod->price }}</span>
{{--                                                <span class="old-price">$32.8</span>--}}
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ $prod->discount }}</span>
                                                <span class="old-price">${{ $prod->price }}</span>
                                            </div>
                                        @endif
                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                        @empty
                            <h5 class="text-danger text-center">No product found</h5>

                    @endforelse
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab two-->
            @endforeach
        </div>
        <!--End tab-content-->
    </div>
</section>
