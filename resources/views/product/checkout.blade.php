@extends('component.layout')
@section('title','Thanh toán')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')


    <div class="alert alert-success"  style="display: none; text-align: center">
        Tạo khách hàng mới thành công
    </div>
    <div class="edgtf-content">
        <div class="edgtf-content-inner">
            <div class="edgtf-full-width">
                <div class="edgtf-full-width-inner">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-page-content-holder edgtf-grid-col-12">
                            <div data-parallax-bg-image="{{asset('/voevod/img/pages-img-3.jpg')}}" data-parallax-bg-speed="1" class="vc_row wpb_row vc_row-fluid vc_custom_1513869155155 edgtf-parallax-row-holder" style="background-image: url(&quot;http://voevod.edge-themes.com/wp-content/uploads/2017/12/pages-img-3.jpg&quot;); background-position: 50% 29px;">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="edgtf-section-title-holder   edgtf-appear edgtf-appeared" style="text-align: center">
                                                <div class="edgtf-st-inner">
                                                    <h1 class="edgtf-st-title" style="color: #ffffff">
                                                        Checkout
                                                    </h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-row-grid-section-wrapper ">
                                @if (!empty(\Illuminate\Support\Facades\Session::has('messages')))
                                    <div class="alert alert-danger" style="text-align: center; margin-top: 10px">
                                        <strong>Errors!</strong> {{\Illuminate\Support\Facades\Session::get('messages')}}
                                    </div>
                                @endif

                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid vc_custom_1514203702005">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper pad-list-user" style="margin-top: 10px">
                                                    <div class="woocommerce">

                                                        <form  method="post" action="{{route('order')}}" class="checkout woocommerce-checkout" enctype="multipart/form-data" >

                                                        @if ($user['info']['member_type'] == 1)
                                                    @component('product.checkout_promoter') @endcomponent

                                                            @else
                                                            @component('product.checkout_customer') @endcomponent
                                                        @endif




                                                            <h3 id="order_review_heading">Hoá đơn của bạn</h3>
                                                            <div class="woocommerce-checkout-review-order">
                                                                <table class="woocommerce-checkout-review-order-table" style="table-layout: fixed">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="product-name">Sản phẩm</th>
                                                                        <th style="width: 50%" class="product-total">Tổng</th>
                                                                    </tr>
                                                                    </thead>



                                                                    <tbody id="drawInCheckout">


                                                                    </tbody>
                                                                    <tfoot>

                                                                    <tr class="order-total">
                                                                        <th>Tổng tiền</th>
                                                                        <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol" id="total-checkout"></span></span></strong> </td>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>

                                                            </div>
                                                            <div class="form-row place-order">
                                                                {{csrf_field()}}
                                                                <input type="submit" class="button alt" id="place_order" value="Tạo hoá đơn" onclick="return validateCustomer()">
                                                            </div>
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

    <div class="modal fade" id="createCustomer" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" id="submitCustomer" method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <div id="overlay2" style="display: none;">
                        <div class="sk-fading-circle" style="top:15%">
                            <div class="sk-circle1 sk-circle"></div>
                            <div class="sk-circle2 sk-circle"></div>
                            <div class="sk-circle3 sk-circle"></div>
                            <div class="sk-circle4 sk-circle"></div>
                            <div class="sk-circle5 sk-circle"></div>
                            <div class="sk-circle6 sk-circle"></div>
                            <div class="sk-circle7 sk-circle"></div>
                            <div class="sk-circle8 sk-circle"></div>
                            <div class="sk-circle9 sk-circle"></div>
                            <div class="sk-circle10 sk-circle"></div>
                            <div class="sk-circle11 sk-circle"></div>
                            <div class="sk-circle12 sk-circle"></div>
                        </div>
                    </div>


                    <div class="alert alert-danger"  style="display: none; text-align: center">
                        <strong id="alert">Error!</strong>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Tên khách hàng:</label>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label">Số điện thoại:</label>
                        <input class="form-control" type="text" name="phone">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email:</label>
                        <input  class="form-control" type="text" name="email">
                    </div>
                        <div class="form-group">
                            <label  class="col-form-label">Địa chỉ:</label>
                            <input  class="form-control" type="text" name="address">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Ảnh đại diện:</label>
                            <input type="file" class="form-control"  name="avatar">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="return createCustomer()" >Tạo khách hàng</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

@section('scripts')
<script type="text/javascript" src="{{asset('/js/checkout.js?v=2')}}"></script>
    @endsection