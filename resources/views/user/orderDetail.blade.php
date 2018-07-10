@extends('component.layout')
@section('title','Chi tiết đơn hàng')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <div class="edgtf-content profile-pad list-product">
        <div class="edgtf-content-inner">
            <div class="edgtf-page-content-holder edgtf-grid-col-12" style="    margin-bottom: 40px;">
                <div class="vc_row wpb_row vc_row-fluid " style="background-image: url({{asset('/voevod/img/blog-titleareaimg-1.jpg')}})">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <div class="edgtf-section-title-holder   edgtf-appear edgtf-appeared" style="text-align: center">
                                    <div class="edgtf-st-inner">
                                        <h1 class="edgtf-st-title" style="color: #ffffff">
                                            Chi tiết đơn hàng
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edgtf-full-width">
                <div class="edgtf-full-width-inner">
                    <div class="edgtf-container-inner clearfix">
                        <div class="edgtf-grid-row">
                            <div class="edgtf-grid-col-6" style="margin-left: 25%;margin-bottom: 20px;">
                                <div class="list-product-item user">
                                    <div class="edgtf-grid-col-3" style="padding-left: 0;">
                                        <div class="avatar">
                                            <div class="avatar-img" style="width: 135px;">
                                                <img src="{{$order_detail['customer']['avatar']}}" style="border-radius: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="edgtf-grid-col-9">
                                        <div class="avatar-profile" style="padding-top: 10px;">
                                            <div class="item">
                                                <span style="color: #e36e3a;font-weight: bold;">{{$order_detail['customer']['name']}}</span>
                                            </div>
                                            <div class="item">
                                                <span>Ngày bán : {{date('d-m-Y',(int)$order_detail['created_at'])}}</span>
                                            </div>
                                            <div class="item">
                                                <span>Người bán : {{!empty($order_detail['creator'])?$order_detail['creator']['name']:"Chưa duyệt hoá đơn này"}}</span>
                                            </div>
                                            <div class="item">
                                                <span>Địa chỉ người mua : {{$order_detail['customer']['address']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="woocommerce" >
                            <div class="woocommerce-cart-form" style="margin: 0;">
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Giá tiền</th>
                                        <th class="product-subtotal">Tổng</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($order_detail['products'] as $item)
                                        <tr class="woocommerce-cart-form__cart-item cart_item">

                                            <td class="product-thumbnail">
                                                <a href="{{route('product.detail',['product_id' => $item['id']])}}" target="_blank">
                                                    <img width="180" height="180" src="{{$item['thumbnail']['link']}}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                                                </a>
                                            </td>
                                            <td class="product-name" data-title="Product">
                                                <a href="{{route('product.detail',['product_id' => $item['id']])}}" target="_blank">{{$item['name']}}</a>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{number_format($item['price'])}}</span>
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="edgtf-quantity-buttons quantity">
                                                    <label class="edgtf-quantity-label">Số lượng</label>
                                                    <strong>{{$item['quantity']}}</strong>
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol"></span>{{number_format($item['money_total'])}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-collaterals" style="margin: 3% 0 100px">
                                <div class="cart_totals ">
                                    <h4>Chi tiết đơn hàng</h4>
                                    <table cellspacing="0" class="shop_table shop_table_responsive">
                                        <tbody>

                                        <tr class="order-total">
                                            <th>Tổng tiền</th>
                                            <td data-title="Total">
                                                <strong>
                                                    <span class="woocommerce-Price-amount amount">{{number_format($order_detail['money'])}}
                                                        <span class="woocommerce-Price-currencySymbol"></span>
                                                    </span>
                                                </strong> </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="wc-proceed-to-checkout">
                                        <p  class="checkout-button button alt wc-forward">
                                        <?php
                                            switch ($order_detail['status']){
                                                case 0: {
                                                    echo("Đã huỷ");
                                                    break;
                                                }
                                                case 1: {
                                                    echo("Đang xử lý");
                                                    break;
                                                }
                                                case 2: {
                                                    echo("Đang vận chuyển");
                                                    break;
                                                }
                                                case 3: {
                                                    echo("Thành công");
                                                    break;
                                                }
                                                default : {
                                                    break;
                                                }
                                            }

                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{--<div class="edgtf-grid-row">--}}
                            {{--@foreach($order_detail['products'] as $item)--}}
                            {{--<div class="edgtf-grid-col-6">--}}
                                {{--<div class="list-product-item">--}}
                                    {{--<div class="edgtf-grid-col-5" style="padding-left: 0;">--}}
                                        {{--<div class="avatar">--}}
                                            {{--<div class="avatar-img">--}}
                                                {{--<img class="order-avatar-detail" src="{{$item['thumbnail']['link']}}" >--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="edgtf-grid-col-7">--}}
                                        {{--<div class="avatar-profile" style="padding-top: 10px;">--}}
                                            {{--<div class="item">--}}
                                                {{--<span style="font-weight: bold;"><a href="{{route('product.detail',['product_id' => $item['id']])}}">{{$item['name']}}</a></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="item">--}}
                                                {{--<span>Số lượng : <strong>{{$item['quantity']}}</strong></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="item">--}}
                                                {{--<span style="color: #e36e3a;">Đơn giá : {{number_format($item['price'])}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div class="item">--}}
                                                {{--<span>Tổng Số lượng : {{number_format($item['money_total'])}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                                {{--@endforeach--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- close div.content_inner -->
    @endsection
