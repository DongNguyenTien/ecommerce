@extends('component.layout')
@section('title',$product_name)

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
                            <div itemprop="breadcrumb" class="edgtf-breadcrumbs ">
                                <a itemprop="url" href="{{route('crm.index')}}">Trang chủ</a><span class="edgtf-delimiter">&nbsp; /&nbsp;</span>{{$product['name']}}<span class="edgtf-delimiter">&nbsp;</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edgtf-container">
                <div class="edgtf-container-inner clearfix">
                     <div id="product-1433" class="post-1433 product type-product status-publish has-post-thumbnail product_cat-multi-tool product_tag-colorfull product_tag-fashion product_tag-hiking product_tag-new-arrivals first instock shipping-taxable purchasable product-type-simple">
                        <div class="edgtf-single-product-content">
                            <div id="images" class="woocommerce-product-gallery images" data-columns="3" style="opacity: 1; transition: opacity 0.25s ease-in-out; width: 50%">
                                <figure class="woocommerce-product-gallery__wrapper">
                                    <div  data-thumb="{{$product['thumbnail']['link']}}" class="woocommerce-product-gallery__image">
                                        <a href="{{$product['thumbnail']['link']}}" data-rel="prettyPhoto[woo_single_pretty_photo]">
                                            <img width="550" height="550" src="{{$product['thumbnail']['link']}}" class="attachment-shop_single size-shop_single wp-post-image" alt="m" title="h3-product-14a" data-caption="{{$product['thumbnail']['caption']}}" data-src="{{$product['thumbnail']['link']}}" data-large_image="{{$product['thumbnail']['link']}}" data-large_image_width="550" data-large_image_height="550">
                                        </a>
                                    </div>
                                        @foreach($product['images'] as $image)
                                        <div data-thumb="{{$product['thumbnail']['link']}}" class="woocommerce-product-gallery__image detail-product-3">
                                            <a href="{{$image['link']}}" data-rel="prettyPhoto[woo_single_pretty_photo]">
                                                <img width="180" height="180" src="{{$image['link']}}" class="attachment-shop_thumbnail size-shop_thumbnail" alt="m" title="h3-product-14-gallery-1"  data-src="{{$image['link']}}" data-large_image="{{$image['link']}}" data-large_image_width="800" data-large_image_height="800" >
                                            </a>
                                        </div>
                                        @endforeach
                                </figure>
                            </div>




                            <div id="edgtf-single-product-summary" class="edgtf-single-product-summary" style="width: 50%">
                                <div class="summary entry-summary">
                                    <h3 itemprop="name" class="edgtf-single-product-title">{{$product['name']}}</h3>
                                    <h4 class="price clearfix"><span class="product-meta"><span class="post-in">Giá: {{number_format($product['price'])}}</span></span></h4>

                                    <div class="woocommerce-product-details__short-description">
                                        <p>{{$product['note']}}</p>
                                    </div>


                                    <div class="edgtf-quantity-buttons quantity">
                                        <label class="edgtf-quantity-label" for="quantity_5a77ae6d99fc0">Số lượng</label>
                                        <span class="edgtf-quantity-minus ion-arrow-left-b"></span>
                                        <input id="quantity" type="text" data-step="1" data-min="1" data-max="" value="1" title="Qty" class="input-text qty text edgtf-quantity-input" size="4" pattern="[0-9]*" inputmode="numeric">
                                        <span class="edgtf-quantity-plus ion-arrow-right-b"></span>
                                    </div>
                                    <button href="" id="add-to-cart" value="1433" class="single_add_to_cart_button button alt">Thêm vào giỏ</button>



                                    <div class="clear"></div>
                                    <div class="product_meta">
                                        <span class="posted_in">Danh mục:
                                            @foreach($product['category'] as $category)
                                            <a href="{{route('product.category',['category_id'=>$category['id']])}}" style="letter-spacing: 0rem">{{$category['name']}}</a>;
                                            @endforeach</span>
                                    </div>

                                    <div class="product_meta">
                                        <span class="posted_in">Có hàng tại:</span>
                                        <ul class="list-stock">
                                            @foreach($product['stock'] as $category)
                                                <div style="float: left;width: 49%">
                                                    <ul class="list-stock">
                                                        <li class="stock-name">{{$category['name']}}</li>
                                                        <ul>
                                                            <li class="stock-detail">{{$category['address']}}</li>
                                                            <li class="stock-detail">ĐT: {{$category['phone']}}</li>
                                                        </ul>

                                                    </ul>
                                                </div>

                                            @endforeach

                                        </ul>

                                    </div>
                                </div>
                                <!-- .summary -->
                            </div>
                        </div>


                        <section class="related products">
                            <hr>
                            <h3>Sản phẩm liên quan</h3>
                            <ul class="products">
                                @foreach($listProduct as $relate_product)
                                <li class="product" style="width:33.333%">
                                    <div class="edgtf-pl-inner">
                                        <div class="edgtf-pl-image" style="height:346.66px">
                                            <img width="440" height="550" src="{{$relate_product['thumbnail']['link']}}" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="m"><span class="edgtf-out-of-stock"></span>
                                            <div class="edgtf-pl-text">
                                                <div class="edgtf-pl-text-outer">
                                                    <div class="edgtf-pl-text-inner">
                                                        <div class="edgtf-yith-wcqv-holder"><a href="{{route('product.detail',['product_id'=>$relate_product['id']])}}" class="yith-wcqv-button" ><i class="edgtf-icon-ion-icon ion-eye "></i></a></div>

                                                        <div class="clear"></div>
                                                        <div class="edgtf-pl-custom-atc-btn"><a class="add_to_cart_button ajax_add_to_cart" href="" onclick="return addToCart('{{$relate_product['id']}}', '{{$relate_product['name']}}', 1, '{{$relate_product['price']}}', '{{$relate_product['thumbnail']['link']}}')"><i class="edgtf-icon-ion-icon ion-ios-cart "></i></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" onclick="return addToCart('{{$relate_product['id']}}', '{{$relate_product['name']}}', 1, '{{$relate_product['price']}}', '{{$relate_product['thumbnail']['link']}}')"></a>
                                    </div>
                                    <div class="edgtf-pl-text-wrapper">
                                        <div class="edgtf-pl-text-wrapper-inner">
                                            <h4 class="edgtf-product-list-title"><a href="{{route('product.detail',['product_id'=>$relate_product['id']])}}">{{$relate_product['name']}}</a></h4>
                                            <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{number_format($relate_product['price'])}}</span></span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                    <!-- #product-1433 -->
                </div>
            </div>
        </div>
        <!-- close div.content_inner -->
    </div>
    <!-- close div.content -->
    @endsection

@section('scripts')
    <script>
        $('button#add-to-cart').on('click',function(){
            var quantity = $('input#quantity').val();
            if (quantity > 0) {
                addToCart('{{$product['id']}}', '{{$product['name']}}', quantity, '{{$product['price']}}', '{{$product['thumbnail']['link']}}')
            }
        })
    </script>
    @endsection