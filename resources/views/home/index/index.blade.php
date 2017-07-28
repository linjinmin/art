@extends('layout.home')



@section('header')
    <link rel="stylesheet" href="/css/unslider-dots.css">
    <link rel="stylesheet" href="/css/unslider.css">
@endsection






@section('body')


    <section class="index-vertical-center">
        <div class="warp">
            <div class="inner fadein-up">
                <h1 class="index-h1" style="float: right;"><span class="index-span">Hi: Welcome,</span></h1>
                {{--<h1 class="index-h1"><span>Enjoy, Share</span></h1>--}}
            </div>
        </div>
    </section>




    {{--<section class="banner">--}}
        {{--<div class=--}}
             {{--"banner-content">--}}
            {{--<div class="image-slideshow banner-slideshow swiper-container">--}}
                {{--<div class="swiper-wrapper">--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<div class="banner-overlay"></div>--}}
                            {{--<div class="banner-main-content">--}}
                            {{--</div>--}}
                            {{--<a href="#"><img class=" img-responsive" src="/images/banner/1.jpg" ></a>--}}
                        {{--</div>--}}

                        {{--<div class="swiper-slide">--}}
                            {{--<div class="banner-overlay"></div>--}}
                            {{--<div class="banner-main-content">--}}
                            {{--</div>--}}
                            {{--<a href="#"><img class=" img-responsive" src="/images/banner/2.jpg" ></a>--}}
                        {{--</div>--}}
                {{--</div>--}}
                {{--<div class="swiper-scrollbar"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

@endsection


@section('footer')
    @include('layout.footer')
    <script>
        $(document).ready(function () {
            var mySwiper1 = new Swiper('.banner .swiper-container',{
                autoplay: 5000,//可选选项，自动滑动
                grabCursor : true,
                loop: true,
                pagination : '.swiper-pagination',
                paginationClickable: true,
                longSwipesRatio: 0.3,
                touchRatio:1,
                observer:true,//修改swiper自己或子元素时，自动初始化swiper
                observeParents:true,//修改swiper的父元素时，自动初始化swiper
            })
        })
    </script>
@endsection





