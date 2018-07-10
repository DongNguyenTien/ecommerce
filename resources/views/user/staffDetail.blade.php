
@extends('component.layout')
@section('title','Thông tin nhân viên')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')

    <div class="edgtf-content profile-pad" style="margin-top: 40px;">
        <div class="edgtf-content-inner">
            <div class="edgtf-page-content-holder edgtf-grid-col-12" style="    margin-bottom: 40px;">
                <div class="vc_row wpb_row vc_row-fluid " style="background-image: url({{asset('/voevod/img/blog-titleareaimg-1.jpg')}})">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <div class="edgtf-section-title-holder   edgtf-appear edgtf-appeared" style="text-align: center">
                                    <div class="edgtf-st-inner">
                                        <h2 class="edgtf-st-title" style="color: #ffffff;font-weight: 600">
                                            Nhân viên:  {{$staff['name']}}
                                        </h2>
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
                            <div class="edgtf-grid-col-12">
                                @component('component.error')@endcomponent
                            </div>
                            <div class="edgtf-grid-col-4">
                                <div class="avatar">
                                    <div class="avatar-img">
                                        <img class="avatar" width="220" height="220" src="{{$staff['avatar']}}" >
                                    </div>
                                    @if ($staff['member_type'] == 1)
                                        <div class="avatar-ct">
                                            <div class="col50">
                                                <p class="title">{{$staff['order']}}</p>
                                                <p class="ct">Đơn hàng</p>
                                            </div>
                                            <div class="col50">
                                                <p class="title">{{$staff['customers']}}</p>
                                                <p class="ct">Khách hàng</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="edgtf-grid-col-8">
                                <div class="avatar-profile">
                                    <div class="item">
                                        <span class="title">Họ và tên :</span>
                                        <span class="ct" style="color: #e36e3a;font-size: 20px;font-weight: bold;">{{$staff['name']}}</span>
                                    </div>
                                    <div class="item">
                                        <span class="title">Điện thoại :</span>
                                        <span class="ct">{{$staff['phone']}}</span>
                                    </div>
                                    <div class="item">
                                        <span class="title">Email :</span>
                                        <span class="ct">{{$staff['email']}}</span>
                                    </div>
                                    <div class="item">
                                        <span class="title">Địa chỉ :</span>
                                        <span class="ct">{{$staff['address']}}</span>
                                    </div>
                                    @if ($staff['member_type'] == 1)
                                        <div class="item">
                                            <span class="title">Thời gian làm việc:</span>
                                            <span class="ct"><?php echo(date('d/m/Y',$staff['from'])) ?> - <?php echo(date('d/m/Y',$staff['to'])) ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="title">Doanh số yêu cầu :</span>
                                            <span class="ct">{{number_format($staff['goal'])}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="title">Doanh số đạt được :</span>
                                            <span class="ct">{{number_format($staff['income'])}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="title">Tỉ lệ :</span>
                                            <span class="ct" style="color: #e36e3a;font-size: 20px;font-weight: bold;">
<!--                                        --><?php //dd(((int)$staff['income']/(int)$staff['goal'])*100,$staff['income']);?>
                                                <?php $target = !empty($staff['goal'])?(int)((int)$staff['income']/(int)$staff['goal']*100):"100" ?>{{$target}} %</span>
                                        </div>

                                    @endif
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
