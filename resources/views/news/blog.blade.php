@extends('component.layout')
@section('title',$category_name)

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <style type="tcss" data-type="vc_shortcodes-custom-css">.vc_row-fluid
        {padding-top: 120px !important;padding-bottom: 45px !important;}
    </style>
    <noscript>&lt;style type="text/css"&gt; .wpb_animate_when_almost_visible { opacity: 1; }&lt;/style&gt;</noscript><style>.fluidvids {width: 100%; max-width: 100%; position: relative;}.fluidvids-item {position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;}</style><script type="text/javascript" charset="UTF-8" src="./Blog Classic – Voevod_files/common.js"></script><script type="text/javascript" charset="UTF-8" src="./Blog Classic – Voevod_files/util.js"></script><script type="text/javascript" charset="UTF-8" src="./Blog Classic – Voevod_files/stats.js"></script><script type="text/javascript" charset="UTF-8" src="./Blog Classic – Voevod_files/AuthenticationService.Authenticate"></script></head>

    <div class="edgtf-content">
        <div class="edgtf-content-inner">
            <div class="edgtf-title-holder edgtf-centered-type edgtf-has-bg-image edgtf-bg-parallax" style="height: 100px; background-image: url('{{asset('/voevod/blog-titleareaimg-2.jpg')}}'); background-position: center -53.0425px;" data-height="433">

                <div class="edgtf-title-wrapper" style="height: 100px">
                    <div class="edgtf-title-inner">
                        <div class="edgtf-grid">
                            <h1 class="edgtf-page-title entry-title" style="color: #ffffff">{{$category_name}}</h1>
                        </div>
                    </div>
                </div>
            </div>


            <div class="edgtf-full-width">
                <div class="edgtf-full-width-inner">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-page-content-holder edgtf-grid-col-12">
                            <div class="edgtf-row-grid-section-wrapper ">
                                <div class="edgtf-row-grid-section">
                                    <div class="vc_row wpb_row vc_row-fluid" style="margin-top: 100px;">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="edgtf-blog-list-holder edgtf-bl-standard edgtf-bl-three-columns edgtf-large-space edgtf-bl-pag-no-pagination">
                                                        <div class="edgtf-bl-wrapper edgtf-outer-space">
                                                            @if(count($news['data']) == 0)
                                                                <h1>Không có bài viết nào</h1>
                                                                @else

                                                            <ul class="edgtf-blog-list">
                                                                @foreach($news['data'] as $item)
                                                                <li class="edgtf-bl-item edgtf-item-space clearfix">
                                                                    <div class="edgtf-bli-inner">

                                                                        <div class="edgtf-post-image" >
                                                                            <a itemprop="url" href="{{route('news.detail',['post_id'=>$item['id']])}}" title="Cross The Line">
                                                                                <img src="{{!empty($item['thumbnail']['link'])?$item['thumbnail']['link']:asset('/voevod/placeholder.jpg')}}" class="attachment-voevod_edge_square size-voevod_edge_square wp-post-image" style="    object-fit: cover;width: 367px;height: 250px;">
                                                                            </a>
                                                                        </div>
                                                                        <div class="edgtf-bli-content">
                                                                            <div class="edgtf-bli-info">
                                                                                <div itemprop="dateCreated" class="edgtf-post-info-date entry-date published updated">
                                                                                    <p >{{date('d F Y',$item['created_at'])}}</p>
                                                                                    <meta itemprop="interactionCount" content="UserComments: 0">
                                                                                </div>                </div>


                                                                            <h5 itemprop="name" class="entry-title edgtf-post-title">
                                                                                <a itemprop="url" href="{{route('news.detail',['post_id'=>$item['id']])}}" title="Cross The Line">{{$item['title']}}</a>
                                                                            </h5>
                                                                            <div class="edgtf-bli-excerpt">
                                                                                <div class="edgtf-post-excerpt-holder">
                                                                                    <p itemprop="description" class="edgtf-post-excerpt">{{$item['summary']}}</p>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                    @endforeach
                                                            </ul>
                                                                @endif

                                                        </div>
                                                    </div></div></div></div></div></div></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="edgtf-woo-pagination-holder">
                <div class="edgtf-woo-pagination-inner">
                    <nav class="woocommerce-pagination">
                        <ul class="page-numbers">
                            @for($i=1; $i<=$total_page; $i++)
                                @if($i == $page)
                                    <li><span class="page-numbers current">{{$i}}</span></li>
                                @else
                                    <li><a class="page-numbers" href="{{route('news.category',['category_id'=>$category_id,'page'=>$i])}}">{{$i}}</a></li>
                                @endif

                            @endfor

                            {{--<li><span class="page-numbers dots">…</span></li>--}}
                        </ul>
                    </nav>
                </div>
            </div>

        </div> <!-- close div.content_inner -->
    </div>  <!-- close div.content -->
    @endsection

@section('scripts')
@endsection