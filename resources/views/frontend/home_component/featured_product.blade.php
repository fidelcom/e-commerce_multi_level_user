@php
    $featured = \App\Models\Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
@endphp

<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach($featured as $product)
                                    <div class="product-cart-wrap">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{  url('product/details/'.$product->id.'/'.$product->slug) }}">
                                                    <img class="default-img" src="{{ asset($product->thumbnail) }}" alt="" />
                                                    <img class="hover-img" src="{{ asset($product->thumbnail) }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            @php
                                                $disc = (($product->price - $product->discount)/ $product->price) * 100;
                                            @endphp
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="{{ $product->discount == NULL ? 'new' : 'hot' }}">{{ $product->discount == NULL ? 'NEW' : round($disc).'%' }}</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="shop-grid-right.html">{{ $product->product_category->name }}</a>
                                            </div>
                                            <h2><a href="{{  url('product/details/'.$product->id.'/'.$product->slug) }}">{{ $product->name }}</a></h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            @if($product->discount == NULL)
                                                <div class="product-price mt-10">
                                                    <span>${{ $product->price }}</span>
                                                    {{--                                                <span class="old-price">$32.8</span>--}}
                                                </div>
                                            @else
                                                <div class="product-price mt-10">
                                                    <span>${{ $product->discount }}</span>
                                                    <span class="old-price">${{ $product->price }}</span>
                                                </div>
                                            @endif
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
{{--                                                <span class="font-xs text-heading"> Sold: 90/120</span>--}}
                                            </div>
                                            <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                        </div>
                                    </div>
                                    <!--End product Wrap-->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
