@extends('layouts.admin_default')
@section('title', trans('news::region_index.title'))
@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d2d6de !important;
            border-radius: 0 !important;
            height: 100% !important;
        }
    </style>
    <section class="content-header">
        <h1>
            {{trans('news::region_index.list')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> {{trans('news::region_index.home')}}</a></li>
            <li class="active">{{trans('news::region_index.list')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div id="overlay" >
                        <div class="bound-load">
                            <span class="loading" id="loading"></span>
                        </div>
                    </div>

                    <div class="box-header">
                        @include('news::includes.message')
                        @if(session()->has('messages'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> {{trans('news::region_index.alert')}}</h4>
                                {{session('messages')}}
                            </div>
                        @else
                        @endif
                        <h3 class="box-title">{{trans('news::region_index.list')}}</h3>

                        <!-- /.box-header -->
                    </div>

                    <div class="box-body">

                        <table class="table table-bordered dataTable">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="name" placeholder="Filter region by Name">
                                        </div>

                                        <div class="col-md-4">

                                                <select class="select2 group col-md-12" id="language" name="lang_code" onchange="return filter()" data-placeholder="{{trans('news::region_index.language')}}">
                                                    <option value="-1" @if(old('lang_code') == -1) selected="selected" @endif>{{trans('news::region_index.all_language')}}</option>
                                                    <option value="vn"  @if(old('lang_code') == 'vn')selected="selected" @endif>Tiếng Việt</option>
                                                    <option value="en" @if(old('lang_code') == 'en') selected="selected" @endif>English</option>
                                                    <option value="fr" @if(old('lang_code') == 'fr') selected="selected" @endif>Francais</option>
                                                </select>

                                        </div>

                                        <div class="col-md-2">
                                            <a class="btn btn-success btn-block" onclick="return filter()"><i class="fa fa-search"></i>&nbsp;{{trans('news::region_index.search')}}</a>
                                        </div>

                                        <div class="col-md-2 pull-right">
                                            <a><button class="btn btn-primary btn-block" onclick="return regionHelper.create();"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{trans('news::region_index.add_region')}}</button></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <div class="table-responsive">
                            <table class="table table-condensed table-hover display compact" id="post_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{trans('news::region_index.name_region')}}</th>
                                    <th>{{trans('news::region_index.language')}}</th>
                                    <th class="actions">{{trans('news::region_index.detail')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div><!--table-responsive-->
                    </div><!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-lte/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        var table = null;
        $(function() {
            table = $('#post_table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                ajax: {
                    "url": '{{ route("news.news_region.get") }}',
                    "type": 'get',
                    data:function(d) {
                        d.language = $('#language option:selected').val();
                        d.name = $('#name').val();
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'lang_code'},
                    {data: 'actions'}

                ],
                "language": {
//                    "lengthMenu": "Hiển thị _MENU_ bản ghi trên một trang",
//                    "zeroRecords": "Không tìm bản ghi phù hợp",
//                    "info": "Đang hiển thị trang _PAGE_ of _PAGES_",
//                    "infoEmpty": "Không có dữ liệu",
//                    "infoFiltered": "(lọc từ tổng số _MAX_ bản ghi)",
//                    "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ kết quả",
//                    "paginate": {
//                        "first":      "Đầu tiên",
//                        "last":       "Cuối cùng",
//                        "next":       "Sau",
//                        "previous":   "Trước"
//                    },
                    "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading '
                },


            });
        });
        function filter(){
            table.draw();
        }

        $('input').on( "keypress", function(event) {
            if (event.which == 13 && !event.shiftKey) {
                event.preventDefault();
                filter();
            }
        });





    </script>

    @endsection