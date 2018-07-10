@extends('layouts.admin_default')
@section('title', trans('news::category_create.title'))
@section('content')
    <section class="content-header">
        <h1>
            {{trans('news::category_create.title')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('news.news_category.index') }}"> {{trans('news::category_create.list_cate')}}</a></li>
            <li class="active">{{trans('news::category_create.add_new')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">

            <form id="form_cat_add" class="form-add-news-category" method="post" action="{{ route('news.news_category.store') }}" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('news::category_create.add_new_2')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('news::includes.message')
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.name')}} (*)</label>
                                <input name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Fill category name" onchange="changeInput(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.slug')}} (*)</label>
                                <input name="slug" id="prefix" type="text" value="{{ old('slug') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.parent_category')}} </label> <span id="special" style="display: none"></span>
                                <select name="parent_id" class="form-control" onchange="changeRegion()" id="category">
                                    <option value="0">{{trans('news::category_create.root_category')}}</option>
                                    {{menuAdd($categories)}}
                                </select>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputEmail1">Vùng ngôn ngữ<span class="loader" style="display:none"></span></label>--}}
                                {{--<select class="form-control region-select" id="language" name="region_id" data-placeholder="Danh mục vùng ngôn ngữ" style="width:100%">--}}

                                    {{--@foreach($regions as $region)--}}
                                        {{--<option class="region" value="{{$region->id}}"  @if(old('region_id') == $region->id)selected="selected" @endif>{{$region->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.cover')}}</label>
                                <input type="file" name="cover" class="form-control preview-upload-image"/>
                                <img src="{{asset('/img/placeholder.jpg')}}" alt="" class="preview-feature-image preview-image"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select category status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Unactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.summary')}}</label>
                                <textarea name="summary" class="form-control" placeholder="Fill summary">{{ old('summary') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_create.position')}}</label>
                                <input name="position" type="number" min="0" step="1" value="{{ empty(old('position')) ? 0 : old('position') }}" class="form-control" placeholder="Fill position">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer">
                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-6 text-right"><button type="submit" class="btn btn-primary" onclick="if(!removeDisabled()) {return false;}">{{trans('news::category_create.save')}}</button></div>
                        <div class="col-md-6 text-left"><a href="{{ route('news.news_category.index') }}" class="btn btn-default">{{trans('news::category_create.cancel')}}</a></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')

    <script src="{{asset('/js/category.js')}}"></script>

@endsection
