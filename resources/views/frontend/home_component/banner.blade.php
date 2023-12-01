<section class="banners mb-25">
    <div class="container">
        <div class="row">
            @foreach(\App\Models\Banner::all() as  $item)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ asset($item->image) }}" alt="" />
                        <div class="banner-text">
                            <h4>
                                {{ $item->title }}
                            </h4>
                            <a href="{{ $item->url }}" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
