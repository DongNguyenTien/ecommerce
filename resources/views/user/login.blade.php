@extends('component.layout')
@section('title','Login')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')

<div class="edgtf-content">
    <div class="edgtf-content-inner">
        <div class="edgtf-full-width">
            <div class="edgtf-full-width-inner">
                <div class="edgtf-grid-row">
                    <div class="edgtf-page-content-holder edgtf-grid-col-12">
                        <div data-parallax-bg-image="{{asset('/voevod/img/pages-img-3.jpg')}}" data-parallax-bg-speed="1" class="vc_row wpb_row vc_row-fluid vc_custom_1513869142679 edgtf-parallax-row-holder" style="background-image: url(&quot;http://voevod.edge-themes.com/wp-content/uploads/2017/12/pages-img-3.jpg&quot;); background-position: 50% 30px;">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="edgtf-section-title-holder   edgtf-appear edgtf-appeared" style="text-align: center">
                                            <div class="edgtf-st-inner" >
                                                <h1 class="edgtf-st-title" style="color: #ffffff">Đăng nhập</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edgtf-row-grid-section-wrapper " style="padding-top: 20px;padding-bottom: 100px;">
                            <div class="edgtf-row-grid-section">
                                <div class="vc_row wpb_row vc_row-fluid vc_custom_1514203702005">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="woocommerce" style="width:93%">
                                                    @component('component.error')@endcomponent
                                                    <form class="woocommerce-form woocommerce-form-login login" action="{{route('login')}}" method="post" >
                                                        {{csrf_field()}}
                                                        {{--<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>--}}
                                                        <p class="form-row form-row-first">
                                                            <label for="username">Số điện thoại <span class="required">*</span></label>
                                                            <input type="text" class="input-text" name="phone" id="username">
                                                        </p>
                                                        <p class="form-row form-row-last">
                                                            <label for="password">Mật khẩu <span class="required">*</span></label>
                                                            <input class="input-text" type="password" name="password" id="password">
                                                        </p>
                                                        <div class="clear"></div>
                                                        <p class="form-row">
                                                            <input type="submit" class="button" name="login" value="Đăng nhập">

                                                        </p>
                                                        <p>
                                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" value="1"> <span>Ghi nhớ</span>
                                                            </label>
                                                        </p>
                                                        <p class="lost_password">
                                                            <a href="{{route('lostPassword')}}">Quên mật khẩu?</a>
                                                        </p>
                                                        <div class="clear"></div>
                                                    </form>

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