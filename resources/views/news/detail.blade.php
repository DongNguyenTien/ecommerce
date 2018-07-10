@extends('component.layout')
@section('title','Trang chủ')

@section('header')
    @component('component.header') @endcomponent

@endsection

@section('content')
    <div class="edgtf-content">
        <div class="edgtf-content-inner">
            <div class="edgtf-container">

                <div class="edgtf-container-inner clearfix">
                    <div class="edgtf-grid-row edgtf-content-has-sidebar edgtf-grid-large-gutter">
                        <div class="edgtf-page-content-holder edgtf-grid-col-9">
                            <div class="edgtf-blog-holder edgtf-blog-single edgtf-blog-single-standard">
                                <article id="post-1059" class="post-1059 post type-post status-publish format-standard has-post-thumbnail hentry category-style tag-art tag-design tag-nature">
                                    <div class="edgtf-post-content">

                                        @if(!empty($news['thumbnail']['link']))
                                        <div class="edgtf-post-heading">
                                            <div class="edgtf-post-image" style="background-image: url('{{$news['thumbnail']['link']}}');">
                                                {{--<img width="1000" height="700" src="{{$news['thumbnail']['link']}}" class="attachment-full size-full wp-post-image"  sizes="(max-width: 1300px) 100vw, 1300px">--}}
                                            </div>
                                        </div>
                                        @endif

                                        <div class="edgtf-post-text">
                                            <div class="edgtf-post-text-inner">
                                                <div class="edgtf-post-info-top">
                                                    <div class="edgtf-post-info-category">
                                                        <a href="{{route('news.category',['category_id'=>$news['category']['category_id']])}}" rel="category tag">{{$news['category']['category_name']}}</a></div>
                                                    <h4 itemprop="name" class="entry-title edgtf-post-title">{{$news['title']}}</h4>

                                                    <div itemprop="dateCreated" class="edgtf-post-info-date entry-date published updated">
                                                        <p>{{date('d F Y',$news['created_at'])}}</p>
                                                        <meta itemprop="interactionCount" content="UserComments: 1">
                                                    </div>

                                                </div>
                                                <div class="edgtf-post-text-main">
                                                    <div class="vc_row wpb_row vc_row-fluid">
                                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                                            <div class="vc_column-inner ">
                                                                <div class="wpb_wrapper">

                                                                    {!! $news['content'] !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="edgtf-post-info-bottom clearfix">
                                                    <div class="edgtf-post-info-bottom-right">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            </div>
                        </div>




                        {{--Sidebar--}}
                        <div class="edgtf-sidebar-holder edgtf-grid-col-3">
                            <aside class="edgtf-sidebar">


                                <div id="categories-2" class="widget widget_categories">
                                    <div class="edgtf-widget-title-holder">
                                        <h4 class="edgtf-widget-title">Danh mục tin</h4></div>
                                    <ul>
                                        @foreach($menus['news'] as $news_category)
                                            <li class="cat-item cat-item-38"><a href="{{route('news.category',['category_id'=>$news_category['id']])}}">{{$news_category['name']}}</a>
                                        @endforeach

                                    </ul>
                                </div>

                                <div class="widget edgtf-separator-widget"><div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
                                        <div class="edgtf-separator" style="border-style: solid;margin-top: 3px"></div>
                                    </div>
                                </div>
                                <div id="text-3" class="widget widget_text">
                                    <div class="edgtf-widget-title-holder">
                                        <h5 class="edgtf-widget-title">Chia sẻ</h5>
                                    </div>
                                    <div class="textwidget"></div>
                                </div>



                                <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -40px 11px 0px 0px;" href="http://www.twitter.com/" target="_blank">
                                    <span class="edgtf-social-icon-widget  social_twitter    "></span>		</a>

                                <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -40px 11px 0px 11px;" href="http://www.facebook.com/" target="_blank">
                                    <span class="edgtf-social-icon-widget  social_facebook    "></span>		</a>

                                <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -40px 11px 0px 11px;" href="http://www.instagram.com/" target="_blank">
                                    <span class="edgtf-social-icon-widget  social_instagram    "></span>		</a>

                                <a class="edgtf-social-icon-widget-holder edgtf-icon-has-hover" data-hover-color="#e36e3a" style="color: #a5a5a5;;font-size: 12px;margin: -40px 11px 0px 11px;" href="http://www.linkedin.com/" target="_blank">
                                    <span class="edgtf-social-icon-widget  social_linkedin    "></span>		</a>
                                <div class="widget edgtf-separator-widget"><div class="edgtf-separator-holder clearfix  edgtf-separator-center edgtf-separator-normal">
                                        <div class="edgtf-separator" style="border-color: #ffffff;border-style: solid;margin-top: 46px;margin-bottom: 0px"></div>
                                    </div>
                                </div>


                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- close div.content_inner -->
    </div>  <!-- close div.content -->
    @endsection