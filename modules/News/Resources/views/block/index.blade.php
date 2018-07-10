@extends('layouts.admin_default')
@section('title', trans('news::block_index.title'))
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
            {{trans('news::block_index.title')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> {{trans('news::block_index.homepage')}}</a></li>
            <li class="active">{{trans('news::block_index.list')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div id="overlay">
                        <div class="bound-load">
                            <span class="loading" id="loading"></span>
                        </div>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">{{trans('news::block_index.list')}}</h3>

                        @include('news::includes.message')
                    @if(session()->has('messages'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> {{trans('news::block_index.alert')}}</h4>
                                {{session('messages')}}
                            </div>
                        @else
                        @endif

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered dataTable">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="name" placeholder="Filter block by Name">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="keyword" placeholder="Filter block by Keyword">
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-success btn-block" onclick="return filter()"><i class="fa fa-search"></i>&nbsp;{{trans('news::category_index.search')}}</a>
                                        </div>

                                        <div class="col-md-2 pull-right">
                                            <a class="btn btn-primary btn-block" href="{{ route('news.news_block.create') }}">{{trans('news::block_index.create')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover" id="post_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{trans('news::block_index.name_block')}}</th>
                                    <th>{{trans('news::block_index.key_word')}}</th>
                                    <th>{{trans('news::block_index.created_at')}}</th>
                                    <th>{{trans('news::block_index.updated_at')}}</th>
                                    <th class="actions">{{trans('news::block_index.action')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div><!--table-responsive-->
                    </div><!-- /.box-body -->
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
    <script>
        $(function() {
           table = $('#post_table').DataTable({
                processing: true,
                serverSide: true,
                bAutoWidth: false,
                searching: false,
                ajax: {
                    url: '{{ route("news.block.get") }}',
                    type: 'get',
                    data: function(d) {
                        d.name = $('#name').val();
                        d.keyword = $('#keyword').val();
                        d.csrf = '{{csrf_field()}}';
                    }

                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data:'key'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
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
                    "sProcessing": '<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading'
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
