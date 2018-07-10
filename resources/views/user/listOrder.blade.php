@extends('component.layout')
@section('title','Danh sách đơn hàng')

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
                                            Danh sách đơn hàng
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
                            <form method="get" action="{{route('listOrder')}}" id="form-list-order">

                            <div class="edgtf-grid-col-12">
                                @component('component.error')@endcomponent
                                    <div class="wpb_wrapper pad-list-user" style="margin-top: 10px">
                                        <div class="woocommerce" style="margin: 0;width: 100%" >
                                            <div class="col2-set" id="customer_details">
                                                <div class="column-1">
                                                    <div class="woocommerce-billing-fields">
                                                        <h4>Tìm kiếm</h4>
                                                        <div class="woocommerce-billing-fields__field-wrapper">

                                                            <p class="form-row form-row-first " style="width: 49%;padding-left: 0px;">
                                                                <label>
                                                                    <strong>Từ: </strong>
                                                                </label>
                                                                <input type="text" name="from"  id="datetimepicker1" value="{{!empty($params['from']) ? date('d-m-Y',$params['from']) : date('d-m-Y',$orders['first_time'])}}" ></p>
                                                            <p class="form-row form-row-last " style="width: 49%;">
                                                                <label>
                                                                    <strong>Đến: </strong>
                                                                </label>
                                                                <input type="text" name="to" id="datetimepicker2" value="{{!empty($params['to']) ? date('d-m-Y',$params['to']) : \Carbon\Carbon::now()->format('d-m-Y')}}" ></p>
                                                            <input type="hidden" value="1" name="page" id="selected_page">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>


                            <div class="edgtf-grid-col-12"  style="padding: 0 !important; min-height: 100px">
                                <div class="wpb_wrapper">
                                    <div class="edgtf-blog-list-holder edgtf-bl-standard edgtf-bl-three-columns edgtf-large-space edgtf-bl-pag-no-pagination">
                                        <div class="edgtf-bl-wrapper edgtf-outer-space">
                                            @component('component.loading')@endcomponent
                                            <ul class="edgtf-blog-list" style="padding: 15px">
                                                @foreach($orders['data'] as $order)
                                                    <li class="edgtf-bl-item edgtf-item-space list-order clearfix">
                                                        <div class="edgtf-bli-inner">

                                                            <div class="edgtf-post-image" >
                                                                <a itemprop="url" href="{{route('detailOrder',['order_id'=>$order['id']])}}" title="{{$order['name']}}">
                                                                    <img src="{{!empty($order['avatar_order'])?$order['avatar_order']:asset('/voevod/placeholder.jpg')}}"  class="attachment-voevod_edge_square size-voevod_edge_square wp-post-image" style="    object-fit: cover;width: 367px;height: 250px;">
                                                                </a>
                                                            </div>
                                                            <div class="edgtf-bli-content">

                                                                <div class="edgtf-grid-col-12" style="padding: 0">
                                                                    <div class="avatar-profile" style="padding-top: 10px;">
                                                                        <div class="item ellipsis" >
                                                                            <span style="color: #e36e3a;font-weight: bold; ">
                                                                                <a class="order-name" href="{{route('detailOrder',['order_id'=>$order['id']])}}">{{$order['name']}}</a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="item">
                                                                            <span>Số lượng : {{$order['quantity']}}</span>
                                                                        </div>
                                                                        <div class="item">
                                                                            <span>Tổng tiền : {{number_format($order['money'])}}</span>
                                                                        </div>
                                                                        <div class="item">
                                                                            <span>Thời gian : {{date('d F Y',$order['created_at'])}}</span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            </form>
                            <div class="edgtf-grid-col-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pull-right" id="pagination-order">
                                        {!! $orders['pagination'] !!}
                                    </ul>
                                </nav>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- close div.content_inner -->
    </div>
    <!-- style page profile -->
 @endsection
@section('scripts')
    <script type="text/javascript">

        function changePage(_this) {
           var select_page = $(_this).attr('value');

           on();
           $('input#selected_page').val(select_page);
           $('form#form-list-order').submit()
            return false;
        }

        $(function () {
            $('#datetimepicker1').datetimepicker({
                format :"DD-MM-YYYY"
            }).on('dp.change', function (e) {
                on();
                $('form#form-list-order').submit();
            });


            $('#datetimepicker2').datetimepicker({
                format :"DD-MM-YYYY"
            }).on('dp.change', function (e) {
                on();
                $('form#form-list-order').submit();
            });
        });

        function filter() {
            on();
            $('form#form-list-order').submit();
        }

    </script>
    @endsection