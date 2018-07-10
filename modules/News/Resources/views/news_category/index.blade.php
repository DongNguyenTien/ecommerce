@extends('layouts.admin_default')
@section('title', trans('news::category_index.title'))
@section('content')
    <section class="content-header">
        <h1>
            {{trans('news::category_index.title')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{trans('news::category_index.list_cate')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">

                    <div class="box-header">
                        @include('news::includes.message')
                        @if(session()->has('messages'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> {{trans('news::category_index.alert')}}</h4>
                                {{session('messages')}}
                            </div>
                        @else
                        @endif
                        <h3 class="box-title">{{trans('news::category_index.list_cate_2')}}</h3>
                    {{--<div class="box-header">--}}


                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table class="table table-bordered dataTable">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control select2" id="category" data-placeholder="Category" onchange="return filter()">
                                                    <option value="-1" @if(old('group') == -1) selected="selected" @endif>{{trans('news::category_index.all_cate')}}</option>
                                                    {{menuIndexPost($categories)}}
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3 " style="margin-top:10px;" >
                                            <input style="height: 30px" type='checkbox'  id="checkHasChildren" name='checkHasChildren' value="1" /> <label style="font-size: 15px;vertical-align: -4px;">    {{trans('news::category_index.included_children')}}</label>
                                        </div>
                                        {{--<div class="col-md-3 " style="margin-top:10px;" >--}}
                                            {{--<input style="height: 30px" type='checkbox'  id="checkTypeOrder" name='checkTypeOrder' value="1" /> <label style="font-size: 15px;vertical-align: -4px;">    {{trans('news::category_index.type_order')}}</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-2">--}}
                                            {{--<a class="btn btn-success btn-block" ><i class="fa fa-search"></i>&nbsp;{{trans('news::category_index.search')}}</a>--}}
                                        {{--</div>--}}
                                        <div class="col-md-2 pull-right">
                                            <a class="btn btn-primary btn-block" href="{{ route('news.news_category.create') }}">{{trans('news::category_index.add_new')}}</a>
                                        </div>
                                    </div>



                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="table-responsive">
                            <table class="table table-condensed table-hover" id="category_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{trans('news::category_index.name')}}</th>
                                    <th>{{trans('news::category_index.cate')}}</th>
                                    <th>{{trans('news::category_index.position')}}</th>
                                    <th>{{trans('news::category_index.status')}}</th>
                                    <th>{{trans('news::category_index.action')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div><!--table-responsive-->
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{asset('js/category.js?v=5')}}"></script>
    <script>
        // $(document).ready(function(){
        //     $('input').iCheck("uncheck");
        // })
        $('input').on('ifChecked', function(event){
            return filter();
        });
        $('input').on('ifUnchecked', function(event){
            return filter();
        });
    </script>
@endsection