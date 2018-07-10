@extends('layouts.admin_default')
@section('title', trans('news::category_edit.title'))
@section('content')
    <section class="content-header">
        <h1>{{trans('news::category_edit.title')}}</h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('news.news_category.index') }}"> {{trans('news::category_edit.list_cate')}}</a></li>
            <li class="active">{{trans('news::category_edit.update')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            {!! Form::open(['method' => 'POST', 'route' => ['news.news_category.update', $category->id], 'id'=> 'form_edit_category','enctype'=>"multipart/form-data"]) !!}
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('news::category_edit.title')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('news::includes.message')
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.name')}} (*)</label>
                                <input name="name" type="text" value="{{ $category->name }}" class="form-control" placeholder="Fill category name" onchange="changeInput(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.slug')}} (*)</label>
                                <input name="slug" id="prefix" type="text" value="{{ $category->slug}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.parent_category')}}</label>
                                <select id="category" name="parent_id" class="form-control" onchange="changeRegion()">
                                    <option value="0">{{trans('news::category_edit.root_category')}}</option>
                                    {{menuEdit($categories,$category->parent_id)}}
                                    {{--@if (isset($categories) && !empty($categories))--}}
                                        {{--@foreach($categories as $parentCategory)--}}
                                            {{--<option value="{{ $parentCategory->id }}" @if($category->parent_id == $parentCategory->id) selected @endif>{{ $parentCategory->prefix }} {{ $parentCategory->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                </select>
                            </div>

                            {{--Region--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputEmail1">Vùng ngôn ngữ<span class="loader" style="display:none"></span></label>--}}
                                {{--<select class="form-control region-select" id="language" name="region_id" data-placeholder="Danh mục vùng ngôn ngữ" style="width:100%" @if($category->parent_id!=0)disabled="disabled" @endif >--}}
                                    {{--@foreach($regions as $region)--}}
                                        {{--<option class="region" value="{{$region->id}}"  @if($category->region_id == $region->id)selected="selected" @endif>{{$region->name}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}


                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.cover')}}</label>
                                <input type="file" name="cover" class="form-control preview-upload-image"/>
                                <img @if($category->cover!="") src="{{ asset('img/category/').'/'.$category->cover}}" @else src="{{asset('/img/placeholder.jpg')}}" @endif  class="preview-feature-image preview-image"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" @if($category->status==1) selected @endif>Active</option>
                                    <option value="0"  @if($category->status==0) selected @endif>Unactive</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.summary')}}</label>
                                <textarea name="summary" class="form-control" placeholder="Fill summary">{{ $category->summary }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{trans('news::category_edit.position')}}</label>
                                <input name="position" type="number" min="0" step="1" value="{{ $category->position }}" class="form-control" placeholder="Fill position">
                            </div>
                            <input name="id" value="{{$category->id}}" style="display:none">
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer">
                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-6 text-right"><button type="submit" onclick="if(!removeDisabled()) {return false;}" class="btn btn-primary">{{trans('news::category_edit.update')}}</button></div>
                        <div class="col-md-6 text-left"><a href="{{ route('news.news_category.index') }}"  class="btn btn-default">{{trans('news::category_edit.cancel')}}</a></div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection



@section('scripts')
    <script src="{{asset('/js/category.js')}}"></script>

@endsection
