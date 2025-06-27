@extends('layouts.app-public')
@section('title', 'Home')
@section('content')
    <div class="site-wrapper--reveal">
        <div class="hero-box-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Hero Slider Area Start -->
                        <div class="hero-area" id="product-preview">
                        </div>
                        <!-- Hero Slider Area End -->
                    </div>
                </div>
            </div>
        </div>

        <div class="about-us-area section-space--ptb_120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-us-content_6 text-center">
                            <h2>Gogh's Gallery&nbsp;&nbsp;Store</h2>
                            <p>
                                <small>
                                Transform your space with Gogh's Gallery – premium paintings, exclusive designs, and wall-worthy art delivered straight to your door.
                                </small>
                            </p>
                            <p class="mt-5">Make use of your creative mind or even,
                                <span class="text-color-primary"> unlock inner worth, one step at a time!</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Video Area Start -->
        <!-- Banner Video Area Start -->
<div class="banner-video-area overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-video-box">
                    <iframe width="560" height="500" src="https://www.youtube.com/embed/PDrjxt2tKIs" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Video Area End -->

        <!-- Banner Video Area End -->

        <!-- Our Brand Area Start -->
        <div class="our-brand-area section-space--pb_90">
            <div class="container">
                <div class="brand-slider-active">
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb1.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb2.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb3.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb4.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb5.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb6.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb7.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-brand-item">
                            <a href="#"><img src="assets/images/brand/partnerb8.jpg" class="img-fluid" alt="Brand Images"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Brand Area End -->

        <!-- Our Member Area Start -->
        <div class="our-member-area section-space--ptb_120">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="member--box">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4">
                                    <div class="section-title small-mb__40 tablet-mb__40">
                                        <h4 class="section-title">Join the community!</h4>
                                        <p>Become one of the member and get discount 50% off</p>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="member-wrap">
                                        <form action="#" class="member--two">
                                            <input class="input-box" type="text" placeholder="Your email address">
                                            <button class="submit-btn"><i class="icon-arrow-right"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Our Member Area End -->

    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{ asset('pages/js/home.js') }}"></script>

@endsection
