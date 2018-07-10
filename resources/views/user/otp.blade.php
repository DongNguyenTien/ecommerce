@extends('component.layout')
@section('title','Lost Password')

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
                                                    <h1 class="edgtf-st-title" style="color: #ffffff">OTP</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-row-grid-section-wrapper ">
                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid ">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="woocommerce">
                                                        @component('component.error')@endcomponent

                                                        <form class="woocommerce-form woocommerce-form-login login" action="{{route('confirmOtp')}}" method="post" >

                                                            {{csrf_field()}}
                                                            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                                                <label for="user_login">Mã Otp (*)</label>
                                                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="otp" id="user_login" required>
                                                            </p>

                                                            <div class="clear"></div>


                                                            <p class="woocommerce-form-row form-row">
                                                                <button type="submit" class="woocommerce-Button button btn btn-default" >Xác nhận</button>
                                                            </p>

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

        </div> <!-- close div.content_inner -->
    </div>  <!-- close div.content -->
    {{--<input type="hidden" id="md5" value="{{$md5}}" name="md5">--}}
    {{--<input type="hidden" id="phone" value="{{$phone}}" name="phone">--}}

@endsection

@section('scripts')
    @endsection