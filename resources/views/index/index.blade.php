@extends('component.layout')
@section('title','Trang chủ')

@section('header')
    @component('index.header_index') @endcomponent

@endsection

@section('content')
    <div class="alert alert-success" style="display: none; text-align: center">
        <strong>Success!</strong> Chúc mừng bạn đã tạo đơn hàng thành công. Tiếp tục mua sản phẩm nhé!
    </div>

    <div class="edgtf-content">
        <div class="edgtf-content-inner">
            <div class="edgtf-full-width">
                <div class="edgtf-full-width-inner">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-page-content-holder edgtf-grid-col-12">


                            @component('index.slider')@endcomponent

                            <div class="vc_row wpb_row vc_row-fluid edgtf-content-aligment-center">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="edgtf-dual-image-carousel swiper-container full-page swiper-container-horizontal edgtf-dual-image-carousel-loaded" data-mouse-wheel-control="no" style="background-image: url(http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-background-img-1.jpg)">
                                                <div class="swiper-wrapper" style="transition-duration: 1000ms; transform: translate3d(-10632.5px, 0px, 0px);">
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Gunmetal watch" data-swiper-slide-index="0" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg" class="attachment-full size-full')}}" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="1" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Gunmetal watch" data-swiper-slide-index="2" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Gunmetal watch" data-swiper-slide-index="3" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4d.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="4" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-title="Gunmetal watch" data-swiper-slide-index="5" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate-next" data-swiper-title="Gunmetal watch" data-swiper-slide-index="0" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="1" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide" data-swiper-title="Gunmetal watch" data-swiper-slide-index="2" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide" data-swiper-title="Gunmetal watch" data-swiper-slide-index="3" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4d.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-prev" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="4" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(-50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-active" data-swiper-title="Gunmetal watch" data-swiper-slide-index="5" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(0%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate swiper-slide-next" data-swiper-title="Gunmetal watch" data-swiper-slide-index="0" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-4-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="1" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Gunmetal watch" data-swiper-slide-index="2" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate" data-swiper-title="Gunmetal watch" data-swiper-slide-index="3" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-1.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-1-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4d.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4d-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-title="Stealth EDC Kit " data-swiper-slide-index="4" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-2.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2017/12/h1-img-2-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4b.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4b-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-title="Gunmetal watch" data-swiper-slide-index="5" style="margin-right: 25px;">
                                                        <div class="edgtf-slide-background-image-holder">
                                                            <div class="edgtf-slide-background-image">
                                                                <img width="1000" height="463" src="{{asset('/voevod/assets/h1-img-3.jpg')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3.jpg 1000w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-300x139.jpg 300w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-3-768x356.jpg 768w" sizes="(max-width: 1000px) 100vw, 1000px">
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-slide-foreground-image-holder">
                                                            <div class="edgtf-slide-foreground-image" data-swiper-parallax="-50%" style="transition-duration: 1000ms; transform: translate3d(50%, 0px, 0px);">
                                                                <img width="451" height="531" src="{{asset('/voevod/assets/h1-img-4a.png')}}" class="attachment-full size-full" alt="m" srcset="http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a.png 451w, http://voevod.edge-themes.com/wp-content/uploads/2018/01/h1-img-4a-255x300.png 255w" sizes="(max-width: 451px) 100vw, 451px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="swiper-navigation">
                                                    <span class="edgtf-swiper-button-prev edgtf-swiper-button" style="top: 231px;"><span class="ion-arrow-left-b"></span></span>
                                                    <span class="edgtf-swiper-button-next edgtf-swiper-button" style="top: 231px;"><span class="ion-arrow-right-b"></span></span>
                                                </div>
                                            </div>
                                            <div class="edgtf-pagination-synced-slider slick-initialized slick-slider edgtf-dual-image-carousel-loaded">
                                                <div class="slick-list" style="padding: 0px 50px;">
                                                    <div class="slick-track" style="opacity: 1; width: 6444px; transform: translate3d(-3222px, 0px, 0px);">
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="-6" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="-5" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned slick-center" data-slick-index="-1" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide" data-slick-index="0" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide" data-slick-index="1" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide" data-slick-index="2" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-active" data-slick-index="3" aria-hidden="false" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-active" data-slick-index="4" aria-hidden="false" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-current slick-active slick-center" data-slick-index="5" aria-hidden="false" style="width: 358px;" tabindex="0">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned slick-active" data-slick-index="6" aria-hidden="false" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned slick-active" data-slick-index="7" aria-hidden="false" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="10" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Stealth EDC Kit                 <span>supreme</span>
                                                            </div>
                                                        </div>
                                                        <div class="edgtf-synced-slide slick-slide slick-cloned" data-slick-index="11" aria-hidden="true" style="width: 358px;" tabindex="-1">
                                                            <div class="edgtf-synced-slide-inner">
                                                                Gunmetal watch                <span>supreme</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a itemprop="url" href="#" target="_self" class="edgtf-btn edgtf-btn-medium edgtf-btn-solid edgtf-btn-icon" style="display: none;">                                    <span class="edgtf-btn-text">Shop Now</span>
                                                <i class="edgtf-icon-ion-icon ion-arrow-right-a "></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="edgtf-row-grid-section-wrapper " style="margin-top: 20px;">
                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid vc_custom_1514298531353">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">

                                                {{--List product of each category product--}}
                                                <div class="wpb_wrapper">
                                                    <div class="edgtf-pl-holder edgtf-standard-layout edgtf-small-space edgtf-four-columns edgtf-info-below-image">
                                                        <div class="edgtf-prl-loading">
                                                            <span class="edgtf-prl-loading-msg">Loading...</span>
                                                        </div>

                                                        {{--A day roi--}}
                                                        <div class="edgtf-pl-outer edgtf-outer-space">
                                                            @foreach($listRepresentationOfEachProduct as $product)
                                                                <div class="edgtf-pli edgtf-item-space edgtf-woo-image-normal-width">
                                                                    <div class="edgtf-pli-inner">
                                                                        <div class="edgtf-pli-image" style="height: 250px;width: 232px">
                                                                            <img width="550" height="550" src="{{$product['data']['thumbnail']['link']}}" class="attachment-full size-full wp-post-image" alt="m">
                                                                        </div>
                                                                        <div class="edgtf-pli-text" >
                                                                            <div class="edgtf-pli-text-outer">
                                                                                <div class="edgtf-pli-text-inner">
                                                                                    <div class="edgtf-yith-wcqv-holder">
                                                                                        <a href="{{route('product.detail',['product_id'=>$product['data']['id']])}}" class="yith-wcqv-button" ><i class="edgtf-icon-ion-icon ion-eye "></i></a>
                                                                                    </div>
                                                                                    <div class="clear"></div>
                                                                                    <div class="edgtf-pli-add-to-cart">
                                                                                        <a href="" class="ajax_add_to_cart add_to_cart_button" onclick="return addToCart('{{$product['data']['id']}}', '{{$product['data']['name']}}', 1, '{{$product['data']['price']}}', '{{$product['data']['thumbnail']['link']}}')">
                                                                                            <i class="edgtf-icon-ion-icon ion-ios-cart "></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <a class="edgtf-pli-link" itemprop="url" href="#" title="Tool"></a>
                                                                    </div>


                                                                    <div class="edgtf-pli-text-wrapper">
                                                                        <div class="edgtf-pl-text-wrapper-inner">
                                                                            <h5 itemprop="name" class="entry-title edgtf-pli-title">
                                                                                <a itemprop="url" href="{{route('product.category',['category_id'=>$product['category_id']])}}"><strong>{{$product['category']}}</strong></a>
                                                                            </h5>
                                                                            <div class="edgtf-pli-price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{number_format($product['data']['price'])}}</span></div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>








                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- close div.content_inner -->
    </div>

    <!-- close div.content -->
@endsection

@section('scripts')
    <script>
        @if(\Illuminate\Support\Facades\Session::has('success'))
        localStorage.clear();
        var html = "";
        $('#number-product-in-card').text(0);
        $('#cart-information').empty();
        $('.alert-success').css('display','block');

        if ($(window).width() <= 680) {
            $('.edgtf-full-width').css('top','-3em');
        } else {
            $(".alert-success").delay(5000).fadeOut();
        }
        <?php \Illuminate\Support\Facades\Session::forget('success') ?>
        @endif
    </script>
@endsection