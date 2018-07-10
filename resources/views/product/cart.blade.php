@extends('component.layout')
@section('title','Giỏ hàng')

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
                                                    <h1 class="edgtf-st-title" style="color: #ffffff">Giỏ hàng</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="edgtf-row-grid-section-wrapper ">
                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid vc_custom_1513869308076">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="woocommerce">
                                                        <form class="woocommerce-cart-form" action="http://voevod.edge-themes.com/cart/" method="post">
                                                            <h3>CHI TIẾT</h3>
                                                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                                                <thead>
                                                                <tr>
                                                                    <th class="product-remove">&nbsp;</th>
                                                                    <th class="product-thumbnail">&nbsp;</th>
                                                                    <th class="product-name">Sản phẩm</th>
                                                                    <th class="product-price">Giá</th>
                                                                    <th class="product-quantity">Giá tiền</th>
                                                                    <th class="product-subtotal">Tổng</th>
                                                                </tr>
                                                                </thead>

                                                                <tbody id="cart-table">


                                                                </tbody>
                                                            </table>
                                                            <a class="edgtf-cart-go-back" itemprop="url" href="{{route('crm.index')}}"><i class="edgtf-icon-ion-icon ion-arrow-left-a "></i>Tiếp tục mua hàng</a>





                                                        </form>
                                                        <div class="cart-collaterals">
                                                            <div class="cart_totals ">
                                                                <h4>Chi tiết đơn hàng</h4>
                                                                <table cellspacing="0" class="shop_table shop_table_responsive">
                                                                    <tbody>

                                                                    <tr class="order-total">
                                                                        <th>Tổng tiền</th>
                                                                        <td data-title="Total"><strong><span class="woocommerce-Price-amount amount" id="cart-total-amount"><span class="woocommerce-Price-currencySymbol"></span></span></strong> </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="wc-proceed-to-checkout">
                                                                    <a href="{{route('checkout')}}" class="checkout-button button alt wc-forward">Thanh toán</a>
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
            </div>
        </div>
        <!-- close div.content_inner -->
    </div>
    <!-- close div.content -->
    @endsection