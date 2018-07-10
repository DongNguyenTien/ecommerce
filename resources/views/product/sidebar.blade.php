


        {{--Category--}}
        <div class="widget woocommerce widget_product_categories">
            <div class="edgtf-widget-title-holder">
                <h4 class="edgtf-widget-title">Danh mục sản phẩm</h4>
            </div>
            <ul class="product-categories">
                @foreach($menus['product'] as $product_category)
                    <li class="cat-item"><a href="{{route('product.category',['category_id'=>$product_category['id']])}}" class=""><span class="item_outer"><span class="item_text">{{$product_category['name']}}</span></span></a></li>
                @endforeach
            </ul>
        </div>
        <div class="widget edgtf-separator-widget">
            <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
                <div class="edgtf-separator" style="border-style: solid;margin-top: 32px"></div>
            </div>
        </div>
        <div class="widget edgtf-separator-widget">
            <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
                <div class="edgtf-separator" style="border-style: solid;margin-top: 2px"></div>
            </div>
        </div>



        {{--Popular--}}

        <div class="widget edgtf-separator-widget">
            <div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
                <div class="edgtf-separator" style="border-style: solid;margin-top: 8px"></div>
            </div>
        </div>


        {{--//Social media--}}
        <div class="widget widget_text">
            <div class="edgtf-widget-title-holder">
                <h3 class="edgtf-widget-title">Social Media</h3>
            </div>
            <div class="textwidget"></div>
        </div>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#0d0d0d" style="color: #a5a5a5;;font-size: 12px;margin: -38px 15px 0px 0px;" href="#" target="_blank">                           <span class="edgtf-social-icon-widget  social_twitter    "></span>      </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#0d0d0d" style="color: #a5a5a5;;font-size: 12px;margin: -38px 15px 0px 0px;" href="#" target="_self">                           <span class="edgtf-social-icon-widget  social_facebook    "></span>     </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#0d0d0d" style="color: #a5a5a5;;font-size: 12px;margin: -38px 15px 0px 0px;" href="#" target="_blank">                           <span class="edgtf-social-icon-widget  social_instagram    "></span>    </a>
        <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#0d0d0d" style="color: #a5a5a5;;font-size: 12px;margin: -38px 0px 0px 0px;" href="#" target="_blank">                           <span class="edgtf-social-icon-widget  social_linkedin    "></span>     </a>
