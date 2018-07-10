@extends('component.layout')
@section('title',$category_name)

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <div class="edgtf-content">
        <div class="edgtf-content-inner">
            <div class="edgtf-title-holder edgtf-breadcrumbs-type" style="height: 100px" data-height="240">
                <div class="edgtf-title-wrapper" style="height: 100px">
                    <div class="edgtf-title-inner">
                        <div class="edgtf-grid">
                            <div itemprop="breadcrumb" class="edgtf-breadcrumbs "><a href="{{route('crm.index')}}">Trang chủ</a><span class="edgtf-delimiter">&nbsp; / &nbsp;</span><span class="edgtf-current">{{$category_name}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edgtf-container">
                <div class="edgtf-container-inner clearfix">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-page-content-holder edgtf-grid-col-9">
                            {{--<p class="woocommerce-result-count">--}}
                                {{--Hiển thị {{$from}} - {{$to}} của {{$totalRecord['data']}} sản phẩm--}}
                            {{--</p>--}}

                            <div class="edgtf-pl-main-holder">
                                @if(count($listProduct) == 0)
                                    <h1>Không có sản phẩm nào</h1>
                                @else
                                <ul class="products">

                                    @foreach($listProduct as $item)
                                        {{--<div class="edgtf-grid-col-4">--}}
                                            <li class="product product-category">
                                                <div class="edgtf-pl-inner" style="width: auto">
                                                    <div class="edgtf-pl-image" style="width:232px ;height:240px">
                                                        <img src="{{$item['thumbnail']['link']}}" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="m">
                                                        <div class="edgtf-pl-text">
                                                            <div class="edgtf-pl-text-outer">
                                                                <div class="edgtf-pl-text-inner">
                                                                    <div class="edgtf-yith-wcqv-holder">
                                                                        <a href="{{route('product.detail',['product_id'=>$item['id']])}}" class="yith-wcqv-button" data-product_id="920"><i class="edgtf-icon-ion-icon ion-eye "></i></a>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <div class="edgtf-pl-custom-atc-btn">
                                                                        <a href="" class="add_to_cart_button ajax_add_to_cart" onclick="return addToCart('{{$item['id']}}', '{{$item['name']}}', 1, '{{$item['price']}}', '{{$item['thumbnail']['link']}}')">
                                                                            <i class="edgtf-icon-ion-icon ion-ios-cart "></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="edgtf-pl-text-wrapper" >
                                                    <div class="edgtf-pl-text-wrapper-inner" style="height: 80px">
                                                        <h4 class="edgtf-product-list-title" style="letter-spacing: 1pt"><a href="{{route('product.detail',['product_id'=>$item['id']])}}">{{$item['name']}}</a></h4>
                                                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{number_format($item['price'])}}</span></span>
                                                    </div>
                                                    <h5 class="edgtf-pl-category"><a href="#" rel="tag">{{$category_name}}</a></h5>

                                                </div>
                                                <a href="http://voevod.edge-themes.com/shop-with-sidebar/#" class="button yith-wcqv-button" data-product_id="920">Quick View</a>
                                            </li>
                                        {{--</div>--}}


                                        @endforeach
                                </ul>
                                    @endif
                            </div>









                            <div class="edgtf-woo-pagination-holder">
                                <div class="edgtf-woo-pagination-inner">
                                    <nav class="woocommerce-pagination">
                                        <ul class="page-numbers">
                                            @for($i=1; $i<=$total_page; $i++)
                                                @if($i == $page)
                                            <li><span class="page-numbers current">{{$i}}</span></li>
                                                    @else
                                                    <li><a class="page-numbers" href="{{route('product.category',['category_id'=>$category_id,'page'=>$i])}}">{{$i}}</a></li>
                                                @endif

                                            @endfor

                                            {{--<li><span class="page-numbers dots">…</span></li>--}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="edgtf-sidebar-holder edgtf-grid-col-3">
                            <aside class="edgtf-sidebar">
                                <div class="widget widget_search">

                                    {{--//Form search product--}}
                                    <form method="get" action="{{route('product.category',['category_id'=>$category_id])}}">
                                        <label class="screen-reader-text">Tìm kiếm: </label>
                                        <div class="input-holder clearfix">
                                            <input type="search" class="search-field" placeholder="Tìm kiếm..." value="{{$key}}" name="key" title="Tìm kiếm:">
                                            <button type="submit" class="edgtf-search-submit"><span aria-hidden="true" class="edgtf-icon-font-elegant icon_search "></span></button>
                                        </div>
                                    </form>
                                </div>
                                @component('product.sidebar') @endcomponent
                            </aside>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- close div.content_inner -->
    </div>
    <!-- close div.content -->
    @endsection