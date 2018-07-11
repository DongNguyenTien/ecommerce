<!DOCTYPE html>
<html lang="en-US" class=" ">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    <title>@yield('title') | {{env('APP_NAME')}}</title>
    <style>
        /* Paste this css to your style sheet file or under head tag */
        /* This only works with JavaScript,
        if it's not present, don't show loader */
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{{asset('/preload/loader-64x/Preloader_2.gif')}}') center no-repeat #fff;
        }
    </style>
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css?v=10')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/loading.css?v=3')}}" media="all">
    <link rel="stylesheet" type="text/css" href="{{asset('/voevod/assets/46ec2.css?v=9')}}" media="all">




    <!-- Bootstrap -->
{{--    <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">--}}

<!--bootstrap tab-->
    {{--    <link rel="stylesheet" href="{{asset('/bootstrap/tag/bootstrap-tagsinput.css')}}">--}}


    {{--<link rel="profile" href="http://gmpg.org/xfn/11">--}}
    {{--<link rel="dns-prefetch" href="http://maps.googleapis.com/">--}}
    {{--<link rel="dns-prefetch" href="http://fonts.googleapis.com/">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=vietnamese" rel="stylesheet">--}}
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <!-- Date time -->
    {{--<link rel="stylesheet" href="{{ asset('/daterangepicker/daterangepicker.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ URL::asset('/dist/css/bootstrap-datetimepicker.min.css') }}" />--}}




    {{--<link rel="dns-prefetch" href="http://s.w.org/">--}}
    {{--<link href="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js">--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />--}}
    <script type="text/javascript" src="{{asset('/voevod/assets/jquery.js')}}"></script>

    {{--    <script src="{{ asset('js/notify.min.js') }}"></script>--}}


    {{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery-migrate.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.themepunch.tools.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.themepunch.revolution.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/voevod/assets/add-to-cart.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('/voevod/assets/woocommerce-add-to-cart.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/voevod/assets/mediaelement-and-player.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/voevod/assets/mediaelement-migrate.min.js')}}"></script>

    <link rel="icon" href="http://voevod.edge-themes.com/wp-content/uploads/2018/01/cropped-favicon-32x32.png" sizes="32x32">
    <link rel="icon" href="http://voevod.edge-themes.com/wp-content/uploads/2018/01/cropped-favicon-192x192.png" sizes="192x192">
    {{--<link rel="apple-touch-icon-precomposed" href="http://voevod.edge-themes.com/wp-content/uploads/2018/01/cropped-favicon-180x180.png">--}}
    {{--<meta name="msapplication-TileImage" content="http://voevod.edge-themes.com/wp-content/uploads/2018/01/cropped-favicon-270x270.png">--}}
    <style id='voevod_edge_woo-inline-css' type='text/css'>
        .page-id-1300.edgtf-boxed .edgtf-wrapper { background-attachment: fixed;}

        .page-id-1300 .edgtf-page-header .edgtf-logo-area { border-bottom: 1px solid #f0f0f0;}

        .page-id-1300 .edgtf-content .edgtf-content-inner > .edgtf-container > .edgtf-container-inner, .page-id-1300 .edgtf-content .edgtf-content-inner > .edgtf-full-width > .edgtf-full-width-inner { padding-top: 0px !important;}


    </style>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding-right: 0px !important;
        }
    </style>
    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>--}}
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });

    </script>
</head>



<body class="page-template page-template-full-width page-template-full-width-php page page-id-1300 edgt-core-1.0 voevod-ver-1.0.1 edgtf-grid-1200 edgtf-fixed-on-scroll edgtf-header-vertical-shadow-disable edgtf-header-vertical-border-disable edgtf-side-menu-slide-from-right" >

<!-- Paste this code after body tag -->
<div class="se-pre-con"></div>
<!-- Ends -->


<div id="yith-wcwl-popup-message" style="display: none;">
    <div id="yith-wcwl-message"></div>
</div>

{{--Scroll--}}
@component('component.extraside')@endcomponent

{{--//Content--}}
<div class="edgtf-wrapper">
    <div class="edgtf-cover"></div>
    <div class="edgtf-wrapper-inner">

        {{--Header--}}
        @yield('header')

        @component('component.goToTop')@endcomponent
        @yield('content')

        {{--Footer    --}}
        @component('component.footer') @endcomponent
    </div>
    <!-- close div.edgtf-wrapper-inner  -->
</div>
<!-- close div.edgtf-wrapper -->
<div id="yith-quick-view-modal">
    <div class="yith-quick-view-overlay"></div>
    <div class="yith-wcqv-wrapper" style="left: 445px; top: 403.5px; width: 1000px; height: 25px;">
        <div class="yith-wcqv-main">
            <div class="yith-wcqv-head">
                <a href="#" id="yith-quick-view-close" class="yith-wcqv-close">X</a>
            </div>
            <div id="yith-quick-view-content" class="woocommerce single-product"></div>
        </div>
    </div>
</div>









<script type="text/template" id="tmpl-unavailable-variation-template">
    <p>Sorry, this product is unavailable. Please choose a different combination.</p>
</script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




<!-- AdminLTE App -->
{{--<script src="{{ URL::asset('/datepicker/moment-with-locales.min.js') }}"></script>--}}
{{--<script src="{{ asset('/datepicker/bootstrap-datepicker.js') }}"></script>--}}
{{--<script src="{{ URL::asset('/js/bootstrap-datetimepicker.min.js') }}"></script>--}}
{{--<script src="{{ asset('/daterangepicker/daterangepicker.js') }}"></script>--}}
{{--<script src="{{ asset('/js/notify.js') }}"></script>--}}

<script type="text/javascript" src="{{asset('/js/addToCart.js?v=5')}}"></script>
<script type="text/javascript" src="{{asset('/js/init.js')}}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>--}}

<!-- VOE App -->
{{--<script type="text/javascript" src="{{asset('/voevod/assets/scripts.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.blockUI.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/js.cookie.min.js')}}"></script>--}}

{{--<script type="text/javascript" src="{{asset('/voevod/assets/cart-fragments.min.js')}}"></script>--}}

{{--<script type="text/javascript" src="{{asset('/voevod/assets/frontend.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.prettyPhoto.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.selectBox.min.js')}}"></script>--}}



{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.yith-wcwl.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/core.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/widget.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/tabs.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/accordion.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/wp-mediaelement.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.appear.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/modernizr.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/voevod/assets/jquery.hoverIntent.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.plugin.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/owl.carousel.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/waypoints.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/Chart.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/voevod/assets/fluidvids.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/voevod/assets/jquery.prettyPhoto.min(1).js')}}"></script>
{{--<script type="text/javascript" src="{{asset('/voevod/assets/perfect-scrollbar.jquery.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/ScrollToPlugin.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/parallax.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.waitforimages.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.easing.1.3.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/isotope.pkgd.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/swiper.min.js')}}"></script>--}}
<script type="text/javascript" src="{{asset('/voevod/assets/slick.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('/voevod/assets/packery-mode.pkgd.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.countdown.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/counter.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/absoluteCounter.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/typed.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.fullPage.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/easypiechart.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/curtain.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/jquery.multiscroll.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/select2.full.min.js')}}"></script>--}}

{{--<script type="text/javascript" src="{{asset('/voevod/assets/js')}}"></script>--}}
{{--<script type="text/javascript">--}}
{{--/* <![CDATA[ */--}}
{{--var edgtfGlobalVars = {"vars":{"edgtfAddForAdminBar":0,"edgtfElementAppearAmount":-100,"edgtfAjaxUrl":"http:\/\/voevod.edge-themes.com\/wp-admin\/admin-ajax.php","edgtfStickyHeaderHeight":0,"edgtfStickyHeaderTransparencyHeight":70,"edgtfTopBarHeight":0,"edgtfLogoAreaHeight":116,"edgtfMenuAreaHeight":116,"edgtfMobileHeaderHeight":70}};--}}
{{--var edgtfPerPageVars = {"vars":{"edgtfStickyScrollAmount":0,"edgtfHeaderTransparencyHeight":232,"edgtfHeaderVerticalWidth":0}};--}}
{{--/* ]]> */--}}
{{--</script>--}}
<script type="text/javascript" src="{{asset('/voevod/assets/modules.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('/voevod/assets/wp-embed.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/js_composer_front.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/underscore.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/wp-util.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/voevod/assets/add-to-cart-variation.min.js')}}"></script>--}}

@yield('scripts')

</body>
</html>