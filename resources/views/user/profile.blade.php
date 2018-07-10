
@extends('component.layout')
@section('title','Profile')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <div class="alert alert-success"  style="display: none; text-align: center">
        Đổi mật khẩu thành công
    </div>


<div class="edgtf-content profile-pad" style="margin-top: 40px;">
    <div class="edgtf-content-inner">
        <div class="edgtf-page-content-holder edgtf-grid-col-12" style="    margin-bottom: 40px;">
            <div class="vc_row wpb_row vc_row-fluid " style="background-image: url({{asset('/voevod/img/blog-titleareaimg-1.jpg')}})">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner ">
                        <div class="wpb_wrapper">
                            <div class="edgtf-section-title-holder   edgtf-appear edgtf-appeared" style="text-align: center">
                                <div class="edgtf-st-inner">
                                    <h1 class="edgtf-st-title" style="color: #ffffff">
                                        Trang cá nhân
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
                        <div class="edgtf-grid-col-12">
                            @component('component.error')@endcomponent
                        </div>
                        <div class="edgtf-grid-col-4">
                            <div class="avatar">
                                <div class="avatar-img">
                                    <img class="avatar" width="220" height="220" src="{{$profile['avatar']}}" >
                                </div>
                                @if ($profile['member_type'] == 1)
                                <div class="avatar-ct">
                                    <div class="col50">
                                        <p class="title">{{$profile['order']}}</p>
                                        <p class="ct">Đơn hàng</p>
                                    </div>
                                    <div class="col50">
                                        <p class="title">{{$profile['customers']}}</p>
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
                                    <span class="ct" style="color: #e36e3a;font-size: 20px;font-weight: bold;">{{$profile['name']}}</span>
                                </div>
                                <div class="item">
                                    <span class="title">Điện thoại :</span>
                                    <span class="ct">{{$profile['phone']}}</span>
                                </div>
                                <div class="item">
                                    <span class="title">Email :</span>
                                    <span class="ct">{{$profile['email']}}</span>
                                </div>
                                <div class="item">
                                    <span class="title">Địa chỉ :</span>
                                    <span class="ct">{{$profile['address']}}</span>
                                </div>
                                @if ($profile['member_type'] == 1)
                                <div class="item">
                                    <span class="title">Thời gian làm việc:</span>
                                    <span class="ct"><?php echo(date('d/m/Y',$profile['from'])) ?> - <?php echo(date('d/m/Y',$profile['to'])) ?></span>
                                </div>
                                <div class="item">
                                    <span class="title">Doanh số yêu cầu :</span>
                                    <span class="ct">{{number_format($profile['goal'])}}</span>
                                </div>
                                <div class="item">
                                    <span class="title">Doanh số đạt được :</span>
                                    <span class="ct">{{number_format($profile['income'])}}</span>
                                </div>
                                <div class="item">
                                    <span class="title">Tỉ lệ :</span>
                                    <span class="ct" style="color: #e36e3a;font-size: 20px;font-weight: bold;">
<!--                                        --><?php //dd(((int)$profile['income']/(int)$profile['goal'])*100,$profile['income']);?>
                                        <?php $target = !empty($profile['goal'])?(int)((int)$profile['income']/(int)$profile['goal']*100):"100" ?>{{$target}} %</span>
                                </div>

                                    @else
                                    <div class="item">
                                        <span class="title">Điểm tích luỹ: </span>
                                        <span class="ct">{{number_format($profile['point'])}}</span>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>


                    <div class="edgtf-grid-row profile-user">
                        @if ($profile['member_type'] == 1)
                        <div class="edgtf-grid-col-6">
                            <div class="md-item">
                                <div class="md-title">
                                    <img width="30" height="30" src="{{asset('voevod/user_group-512.png')}}" >
                                    <span>Quản lý nhóm bán hàng</span>
                                </div>
                                <div class="md-content">
                                    <div class="item-ct">
                                        <a href="{{route('listStaff')}}">Doanh số thành viên trong nhóm <span>></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edgtf-grid-col-6">
                            @else
                                <div class="edgtf-grid-col-12">
                                @endif
                            <div class="md-item">
                                <div class="md-title">
                                    <img width="30" height="30" src="{{asset('/voevod/setting.png')}}" >
                                    <span>Cài đặt</span>
                                </div>
                                <div class="md-content">
                                    <div class="item-ct">
                                        <a href="{{route('listOrder')}}">Xem danh sách đơn hàng <span>></span></a>
                                    </div>
                                    <div class="item-ct">
                                        <a href="#changePassword" data-toggle="modal" data-target="#changePassword">Đổi mật khẩu <span>></span></a>
                                    </div>
                                    <div class="item-ct">
                                        <a href="{{route('logout')}}">Đăng xuất<span>></span></a>
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
<!-- style page profile -->

    <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @component('component.loading')@endcomponent

                    {{--<form action="{{route('changePassWithoutOtp'}}" method="post">--}}
                        <input id="token" type="hidden" value="{{csrf_token()}}">
                        <div class="alert alert-danger"  style="display: none; text-align: center">
                            <strong id="alert">Error!</strong>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Mật khẩu cũ:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="col-form-label">Mật khẩu mới:</label>
                            <input class="form-control" type="password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="re_new_password" class="col-form-label">Xác nhận mật khẩu:</label>
                            <input  class="form-control" type="password" name="re_new_password" required>
                        </div>
                    {{--</form>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="return requestForm()">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    @endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('/js/profile.js')}}">

    </script>
    @endsection