@extends('component.layout')
@section('title','Thông báo')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <div class="edgtf-content" >
        @component('component.loading')@endcomponent
        <div class="edgtf-content-inner">
            <div class="edgtf-title-holder edgtf-breadcrumbs-type" style="height: 100px" >
                <div class="edgtf-title-wrapper" style="height: 100px">
                    <div class="edgtf-title-inner">
                        <div class="edgtf-grid">
                            <div itemprop="breadcrumb" class="edgtf-breadcrumbs ">
                                <a itemprop="url" href="{{route('crm.index')}}">Trang chủ</a>
                                <span class="edgtf-delimiter">&nbsp; / &nbsp;</span>
                                <a itemprop="url" href="#">Thông báo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="edgtf-full-width">
                <div class="edgtf-full-width-inner">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-page-content-holder edgtf-grid-col-12">
                            <div class="edgtf-row-grid-section-wrapper "  >
                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid vc_custom_1513610263745" >
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">

                                                    @foreach($notifications['data'] as $item)
                                                    <div class="wpb_text_column wpb_content_element " >
                                                        <div class="wpb_wrapper">
                                                            <div class="edgtf-icon-list-holder " >
                                                                @if ($item['is_read'] == 1)
                                                                <div class="edgtf-il-icon-holder" id="div-content-{{$item['id']}}">
                                                                    <i class="edgtf-icon-ion-icon ion-checkmark  " style="color: #e36e3a;font-size: 20px"></i>
                                                                </div>
                                                                    @else
                                                                    <div class="edgtf-il-icon-holder" id="div-content-{{$item['id']}}">
                                                                        <i class="edgtf-icon-ion-icon ion-android-mail  " style="color: #e36e3a;font-size: 20px"></i>
                                                                    </div>
                                                                @endif
                                                                <h3 class="edgtf-il-text" style="font-size: 15px;padding-left: 25px">
                                                                    <a href="" onclick="return readNotification({{$item['id']}})">{{$item['title']}}</a>
                                                                </h3>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="vc_empty_space"   style="height: 12px" ><span class="vc_empty_space_inner"></span></div>

                                                    <div class="wpb_text_column wpb_content_element " >
                                                        <div class="wpb_wrapper">
                                                            <p id="p-content-{{$item['id']}}">{{$item['content']}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="vc_empty_space"   style="height: 44px" ><span class="vc_empty_space_inner"></span></div>
                                                        @endforeach

                                                </div>

                                                <div class="edgtf-grid-col-12">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination" id="pagination-notification">
                                                            {!! $notifications['pagination'] !!}
                                                        </ul>
                                                    </nav>
                                                </div>

                                                <form method="get" action="{{route('notification')}}" id="notification">
                                                    <input type="hidden" value="1" name="page" id="selected_page">
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

        </div> <!-- close div.content_inner -->
    </div>  <!-- close div.content -->
    @endsection

@section('scripts')
    <script type="text/javascript">
        function readNotification(noti_id) {
            on();
            $.ajax({
                type: 'get',
                url: '{{route('readNotification')}}',
                data: {
                  notification_id: noti_id
                },
                success: function(data) {
                    off();
                    $('p#p-content-'+noti_id).text(data['content']);
                    $('#div-content-'+noti_id+' > i').addClass('ion-checkmark').removeClass('ion-android-mail');
                    return false;
                }

            });
            return false;
        }

        function changePage(_this) {
            var select_page = $(_this).attr('value');
            on();
            $('input#selected_page').val(select_page);
            $('form#notification').submit();
            return false;
        }

        $(document).ready(function(){
            $('#overlay').css('z-index',1050);
            $('.sk-fading-circle').css('top','20%');
        })
    </script>
    @endsection