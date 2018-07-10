@extends('component.layout')
@section('title','Danh sách nhân viên')

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
                                            Danh sách nhân viên
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
                            <form action="{{route('listStaff')}}" method="get" id="form-list-staff">
                                <input type="hidden" value="1" name="page" id="selected_page">

                                <div class="edgtf-grid-col-12 pad-list-user woocommerce" style="margin: 0">
                                    @component('component.error')@endcomponent
                                        <div class="woocommerce-info"><span style="float: left;margin-right: 50px;">Danh sách khách hàng</span>
                                            <div class="searchform" id="searchform-72" style="float: left;">
                                                <label class="screen-reader-text">Search for:</label>
                                                <div class="input-holder clearfix" style="position: relative;">
                                                    <input type="text" class="input-text " placeholder="Tìm khách hàng..." name="key" style="width: 400px;" value="{{!empty($params['key']) ? $params['key']:""}}" onkeyup="return searchStaff()">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="edgtf-grid-col-12">
                                    @component('component.loading')@endcomponent
                                        @foreach($staffs['data'] as $staff)
                                            <div class="edgtf-grid-col-6" >
                                                <div class="list-product-item staff-detail">
                                                    <div class="edgtf-grid-col-5" style="padding-left: 0;">
                                                        <div class="avatar">
                                                            <div class="avatar-img">
                                                                <img class="order-avatar" src="{{$staff['avatar']}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="edgtf-grid-col-7">
                                                        <div class="avatar-profile" style="padding-top: 10px;">
                                                            <div class="item" >
                                                                <span style="color: #e36e3a;font-weight: bold; "><a href="{{route('detailStaff',['staff_id' => $staff['id']])}}" >{{$staff['name']}}</a></span>
                                                            </div>
                                                            <div class="item">
                                                                <span>Số lượng : {{$staff['phone']}}</span>
                                                            </div>
                                                            <div class="item">
                                                                <span>Thời gian : <?php echo(date('d/m/Y',$staff['from'])) ?> - <?php echo(date('d/m/Y',$staff['to'])) ?></span>
                                                            </div>
                                                            <div class="item">
                                                                <span>Thời gian : <?php echo(number_format($staff['income'])) ?> / <?php echo(number_format($staff['goal'])) ?></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                </div>


                            </form>

                            <div class="edgtf-grid-col-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pull-right">
                                        {!! $staffs['pagination'] !!}
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
            var select_page = $(_this).val();
            on();
            $('input#selected_page').val(select_page);
            $('form#form-list-staff').submit()
        }

        function searchStaff() {
            on();
            $('form#form-list-staff').submit()
        }

    </script>
@endsection