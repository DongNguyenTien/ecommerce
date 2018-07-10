<section class="edgtf-side-menu ps ps--theme_default ps--active-y" >
    <div class="edgtf-side-area-inner">
        <div class="edgtf-close-side-menu-holder">
            <a class="edgtf-close-side-menu" href="#" target="_self">         <span aria-hidden="true" class="edgtf-icon-font-elegant icon_close "></span>            </a>
        </div>
        <div id="text-10" class="widget edgtf-sidearea widget_text">
            <div class="textwidget">
                @if (!empty(\Illuminate\Support\Facades\Cookie::get('user')))
                    <?php $cookie = \Illuminate\Support\Facades\Cookie::get('user');
                    $user = json_decode($cookie, true);
                    ?>
                    <p><a href="{{route('profile')}}"><img class="avatar" src="{{$user['info']['avatar']}}" alt="m" width="150" height="150"></a></p>
                    <p style="font-size: 26px;color: #e36e3a;">{{$user['info']['name']}}</p>
                @else
                    <p><a href="{{route('profile')}}"><img class="avatar" src="{{asset('/logo.jpg')}}" alt="m" width="150" height="150"></a></p>

                @endif

            </div>
        </div>
        <div id="text-11" class="widget edgtf-sidearea widget_text">
            <div class="textwidget">
                <div>
                    <a style="margin-bottom: 10px;display: inline-block;width: 100%;margin-top: 10px;" href="#">
                        <img class="&lt;code&gt; aligncenter" src="{{asset('/voevod/assets/separator-img1.png')}}" alt="d"></a>
                    {{--                    <img class="&lt;code&gt; aligncenter" src="{{asset('/voevod/assets/separator-img1.png')}}" alt="d">--}}

                    @if (!empty(\Illuminate\Support\Facades\Cookie::get('user')))
                        <div class="extra-user-info">
                            <a class="extra-link" style="background: #337ab7" href="{{route('notification')}}">Thông báo <span class="badge" style="background-color: #fff; color: #337ab7">{{$menus['notification']}}</span></a>
                        </div>
                        <div class="extra-user-info">
                            <a class="extra-link" href="/logout">Đăng xuất</a>
                        </div>

                        {{--<span style="color: #0d0d0d; font-size: 15px; line-height: 26px; font-weight: 300; align: center; text-align: center;"><a href="/logout" class="button">Logout</a></span>--}}
                    @else
                        <div style="margin-bottom: 10px;display: inline-block;width: 100%;text-align: center;">
                            <a style="margin-bottom: 10px;display: inline-block;width: 120px;line-height: 40px;
                        background: #e36e3a;color: #fff;" href="/login">Đăng nhập</a>
                        </div>
                        {{--<span style="color: #0d0d0d; font-size: 15px; line-height: 26px; font-weight: 300; align: center; text-align: center;"><a href="/login" class="button">Login</a></span>--}}
                    @endif
                    <div class="vc_empty_space" style="height: 12px"><span class="vc_empty_space_inner"></span></div>
                    <div class="vc_empty_space" style="height: 15px"><span class="vc_empty_space_inner"></span></div>
                </div>
            </div>
        </div>


        <div id="text-13" class="widget edgtf-sidearea widget_text">
            <div class="edgtf-widget-title-holder">
                <h4 class="edgtf-widget-title">Follow Us</h4>
            </div>
            <div class="textwidget"></div>
        </div>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -68px 15px 0px 0px;" href="#" target="_blank">      <span class="edgtf-social-icon-widget  social_twitter    "></span>      </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -68px 15px 0px 0px;" href="#" target="_blank">      <span class="edgtf-social-icon-widget  social_facebook    "></span>     </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -68px 15px 0px 0px;" href="#" target="_blank">      <span class="edgtf-social-icon-widget  social_instagram    "></span>    </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -68px 0px 0px 0px;" href="#" target="_blank">      <span class="edgtf-social-icon-widget  social_linkedin    "></span>     </a>
    </div>
    <div class="edgtf-side-area-bottom">
    </div>
    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
        <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__scrollbar-y-rail" style="top: 0px; height: 832px; right: 0px;">
        <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 736px;"></div>
    </div>
</section>