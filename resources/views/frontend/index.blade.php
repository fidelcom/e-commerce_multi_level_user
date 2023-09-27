@extends('layouts.master')

@section('main')
    @include('frontend.home_component.slider')
    <!--End hero slider-->
    @include('frontend.home_component.features_category')
    <!--End category slider-->
    @include('frontend.home_component.banner')
    <!--End banners-->




    @include('frontend.home_component.new_product')
    <!--Products Tabs-->




    @include('frontend.home_component.featured_product')
    <!--End Best Sales-->









    <!-- TV Category -->

    @include('frontend.home_component.tv_category')
    <!--End TV Category -->





    <!-- Tshirt Category -->

    @include('frontend.home_component.tshirt_category')
    <!--End Tshirt Category -->








    <!-- Computer Category -->

    @include('frontend.home_component.computer_category')
    <!--End Computer Category -->




















    @include('frontend.home_component.hot_deals')
    <!--End 4 columns-->









    <!--Vendor List -->

    @include('frontend.home_component.vendor')


    <!--End Vendor List -->
@endsection
