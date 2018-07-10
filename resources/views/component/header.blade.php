


<header class="edgtf-page-header" style="margin-bottom: 116px;">
    <div class="edgtf-fixed-wrapper fixed">
        <div class="edgtf-menu-area edgtf-menu-right" style="height: 116px;">
            <div class="edgtf-vertical-align-containers">
                <div class="edgtf-position-left">
                    <div class="edgtf-position-left-inner">
                        <div class="edgtf-logo-wrapper">
                            <a itemprop="url" href="{{route('crm.index')}}" style="height: 78px;">                           <img itemprop="image" class="edgtf-normal-logo" src="{{asset('/logo.jpg')}}" width="190" height="156" alt="logo">
                                <img itemprop="image" class="edgtf-dark-logo" src="{{asset('/logo.jpg')}}" width="190" height="156" alt="dark logo">        <img itemprop="image" class="edgtf-light-logo" src="{{asset('/logo.jpg')}}" width="190" height="156" alt="light logo">    </a>
                        </div>
                    </div>
                </div>
                <div class="edgtf-position-right">
                    <div class="edgtf-position-right-inner">
                        <nav class="edgtf-main-menu edgtf-drop-down edgtf-default-nav">
                            <ul id="menu-main-menu-main-navigation-mobile-navigation" class="clearfix">
                                <li id="nav-menu-item-10" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children edgtf-active-item has_sub narrow">
                                    <a href="{{route('crm.index')}}" class=" current "><span class="item_outer"><span class="item_text">Trang chủ</span><i class="edgtf-menu-arrow ion-arrow-right-a"></i></span></a>
                                </li>

                                {{--Shop--}}
                                <li id="nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow">
                                    <a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_text">Cửa hàng</span><i class="edgtf-menu-arrow ion-arrow-right-a"></i></span></a>
                                    <div class="second" style="height: 0px;">
                                        <div class="inner">
                                            <ul>
                                                @foreach($menus['product'] as $product_category)
                                                    <li id="nav-menu-item-1062" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('product.category',['category_id'=>$product_category['id']])}}" class=""><span class="item_outer"><span class="item_text">{{$product_category['name']}}</span></span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                {{--News--}}
                                <li id="nav-menu-item-13" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow">
                                    <a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_text">Tin tức</span><i class="edgtf-menu-arrow ion-arrow-right-a"></i></span></a>
                                    <div class="second" style="height: 0px;">
                                        <div class="inner">
                                            <ul>
                                                @foreach($menus['news'] as $news_category)
                                                    <li id="nav-menu-item-2223" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('news.category',['category_id'=>$news_category['id']])}}" class=""><span class="item_outer"><span class="item_text">{{$news_category['name']}}</span></span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>


                                {{--Profile--}}
                                <li id="nav-menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow">
                                    <a href="#" class=" no_link" onclick="JavaScript: return false;"><span class="item_outer"><span class="item_text">Trang cá nhân</span><i class="edgtf-menu-arrow ion-arrow-right-a"></i></span></a>
                                    <div class="second" style="height: 0px;">
                                        <div class="inner">
                                            <ul>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('profile')}}" class=""><span class="item_outer"><span class="item_text">Profile</span></span></a></li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('listOrder')}}" class=""><span class="item_outer"><span class="item_text">Danh sách đơn hàng</span></span></a></li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('notification')}}" class=""><span class="item_outer"><span class="item_text">Thông báo @if(!empty($menus['notification'])) (<span style="color: #0f3e68; font-weight:800">{{$menus['notification']}}</span>) @endif</span></span></a></li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('cart')}}" class=""><span class="item_outer"><span class="item_text">Giỏ hàng của bạn</span></span></a></li>
                                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('checkout')}}" class=""><span class="item_outer"><span class="item_text">Thanh toán</span></span></a></li>
                                                @if (\Illuminate\Support\Facades\Cookie::has('user'))
                                                    <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('logout')}}" class=""><span class="item_outer"><span class="item_text">Đăng xuất</span></span></a></li>
                                                @else
                                                    <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('login')}}" class=""><span class="item_outer"><span class="item_text">Đăng nhập</span></span></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                {{-- About us --}}
                                <li id="nav-menu-item-11" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub narrow">
                                    <a href="#" class=""><span class="item_outer"><span class="item_text">Về chúng tôi</span><i class="edgtf-menu-arrow ion-arrow-right-a"></i></span></a>
                                    <div class="second" style="height: 0px;">
                                        <div class="inner">
                                            <ul>
                                                <li id="nav-menu-item-1154" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">About Us</span></span></a></li>
                                                <li id="nav-menu-item-2999" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">Our Team</span></span></a></li>
                                                <li id="nav-menu-item-1291" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">Pricing Plans</span></span></a></li>
                                                <li id="nav-menu-item-3010" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">Store Locator</span></span></a></li>
                                                <li id="nav-menu-item-1275" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">Contact Us</span></span></a></li>
                                                <li id="nav-menu-item-2998" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">FAQ Page</span></span></a></li>
                                                <li id="nav-menu-item-2190" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span class="item_outer"><span class="item_text">Coming Soon</span></span></a></li>
                                                <li id="nav-menu-item-3534" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="#" class=""><span class="item_outer"><span class="item_text">404 Error Page</span></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </nav>

                        <div class="edgtf-shopping-cart-holder">
                            <div class="edgtf-shopping-cart-inner">
                                <a itemprop="url" class="edgtf-header-cart" href="#">                                 <span class="edgtf-cart-icon">
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="33px" viewBox="0 0 24 33" enable-background="new 0 0 24 33" xml:space="preserve">
                                             <g>
                                                <path fill="#0D0D0D" d="M22.697,5.3v26.396H1.3V5.3H22.697 M24,4H0v28.996h24V4L24,4z"></path>
                                             </g>
                                             <g>
                                                <path fill="#0D0D0D" d="M16.697,1.3v2.692H7.3V1.3H16.697 M17.997,0H6v5.292h11.997V0L17.997,0z"></path>
                                             </g>
                                          </svg>
                                          <span class="edgtf-cart-number" id="number-product-in-card"></span>
                                      </span>
                                </a>
                                <div class="edgtf-shopping-cart-dropdown">
                                    <ul id="cart-information">

                                    </ul>
                                </div>
                            </div>
                        </div>



                        <a class="edgtf-side-menu-button-opener edgtf-icon-has-hover" href="#" style="margin: 0px 0px 0px 21px">                        <span class="edgtf-side-menu-icon">
                              <span class="edgtf-fm-line edgtf-line-1"></span>
                              <span class="edgtf-fm-line edgtf-line-2"></span>
                              <span class="edgtf-fm-line edgtf-line-3"></span>
                              </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<header class="edgtf-mobile-header edgtf-animate-mobile-header mobile-header-appear" style="margin-bottom: 70px;">
    <div class="edgtf-mobile-header-inner">
        <div class="edgtf-mobile-header-holder">
            <div class="edgtf-grid">
                <div class="edgtf-vertical-align-containers">
                    <div class="edgtf-vertical-align-containers">
                        <div class="edgtf-mobile-menu-opener">
                            <a href="#">                           <span class="edgtf-mobile-menu-icon">
                                 <span aria-hidden="true" class="edgtf-icon-font-elegant icon_menu "></span>                           </span>
                            </a>
                        </div>
                        <div class="edgtf-position-center">
                            <div class="edgtf-position-center-inner">
                                <div class="edgtf-mobile-logo-wrapper">
                                    <a itemprop="url" href="{{route('crm.index')}}" style="height: 50px">
                                        <img itemprop="image" src="{{asset('/logo.jpg')}}" width="344" height="100" alt="Mobile Logo">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="edgtf-position-right">
                            <div class="edgtf-position-right-inner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <nav class="edgtf-mobile-nav" >
            <div class="edgtf-grid">


                <ul id="menu-mobile-menu" class="">
                    {{--Homepage--}}
                    <li id="mobile-menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children edgtf-active-item has_sub">
                        <a href="{{route('crm.index')}}" class=" current  edgtf-mobile-no-link"><span>Trang chủ</span></a><span class="mobile_arrow"><i class="edgtf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>

                    </li>



                    {{--Cua hang--}}
                    <li id="mobile-menu-item-18" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                        <a href="#" class=" edgtf-mobile-no-link"><span>Cửa hàng</span></a><span class="mobile_arrow"><i class="edgtf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                        <ul class="sub_menu">
                            @foreach($menus['product'] as $product_category)
                                <li id="nav-menu-item-1062" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('product.category',['category_id'=>$product_category['id']])}}" class=""><span class="item_outer"><span class="item_text">{{$product_category['name']}}</span></span></a></li>
                            @endforeach
                        </ul>
                    </li>

                    {{--Tin tuc--}}
                    <li id="mobile-menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                        <a href="#" class=" edgtf-mobile-no-link"><span>Tin tức</span></a><span class="mobile_arrow"><i class="edgtf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                        <ul class="sub_menu">
                            @foreach($menus['news'] as $news_category)
                                <li id="nav-menu-item-2223" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('news.category',['category_id'=>$news_category['id']])}}" class=""><span class="item_outer"><span class="item_text">{{$news_category['name']}}</span></span></a></li>
                            @endforeach
                        </ul>
                    </li>





                    <li id="mobile-menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                        <a href="#" class=" edgtf-mobile-no-link"><span>Trang cá nhân</span></a><span class="mobile_arrow"><i class="edgtf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                        <ul class="sub_menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('profile')}}" class=""><span class="item_outer"><span class="item_text">Profile</span></span></a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('listOrder')}}" class=""><span class="item_outer"><span class="item_text">Danh sách đơn hàng</span></span></a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('notification')}}" class=""><span class="item_outer"><span class="item_text">Thông báo @if(!empty($menus['notification'])) (<span style="color: #0f3e68; font-weight:800">{{$menus['notification']}}</span>) @endif</span></span></a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('cart')}}" class=""><span class="item_outer"><span class="item_text">Giỏ hàng của bạn</span></span></a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('checkout')}}" class=""><span class="item_outer"><span class="item_text">Thanh toán</span></span></a></li>
                            @if (\Illuminate\Support\Facades\Cookie::has('user'))
                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('logout')}}" class=""><span class="item_outer"><span class="item_text">Đăng xuất</span></span></a></li>
                            @else
                                <li class="menu-item menu-item-type-post_type menu-item-object-page "><a href="{{route('login')}}" class=""><span class="item_outer"><span class="item_text">Đăng nhập</span></span></a></li>
                            @endif
                        </ul>
                    </li>


                    {{--About us--}}
                    <li id="mobile-menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children  has_sub">
                        <a href="#" class=" edgtf-mobile-no-link"><span>Về chúng tôi</span></a><span class="mobile_arrow"><i class="edgtf-sub-arrow fa fa-angle-right"></i><i class="fa fa-angle-down"></i></span>
                        <ul class="sub_menu">
                            <li id="mobile-menu-item-1146" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>About Us</span></a></li>
                            <li id="mobile-menu-item-2205" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Our Team</span></a></li>
                            <li id="mobile-menu-item-2198" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Pricing Plans</span></a></li>
                            <li id="mobile-menu-item-2199" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Store Locator</span></a></li>
                            <li id="mobile-menu-item-2197" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Contact Us</span></a></li>
                            <li id="mobile-menu-item-2203" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>FAQ Page</span></a></li>
                            <li id="mobile-menu-item-2189" class="menu-item menu-item-type-post_type menu-item-object-page "><a href="#" class=""><span>Coming Soon</span></a></li>
                            <li id="mobile-menu-item-3535" class="menu-item menu-item-type-custom menu-item-object-custom "><a href="#" class=""><span>404 Error Page</span></a></li>
                        </ul>
                    </li>


                </ul>
            </div>
            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;">
                <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </nav>
    </div>
</header>