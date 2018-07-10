@extends('layouts.admin_default')
@section('title', trans('core::group.title'))
@section('content')
    <section class="content-header">
        <h1>{{trans('core::group.title')}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin_home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('core.group.index') }}"> {{trans('core::group.title')}}</a></li>
            <li class="active">{{trans('core::group.add')}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('core::group.add_group')}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            {!! Form::open(['method' => 'POST', 'route' => ['core.group.store'], 'class' => 'validate']) !!}
                <div class="row">
                    <div class="col-md-6">
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>{{trans('core::group.name')}} (*)</label>
                            <input name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="{{trans('core::group.enter_name_group')}}" required>
                        </div>
                        <div class="form-group">
                            <label>{{trans('core::group.type')}} (*)</label>
                            {!! Form::select('type', [
                                    0 => trans('core::group.admin_account'),
                                    1 => trans('core::group.staff_account')
                                ],
                                old('type'),
                                ['id' => 'selectType', 'class'=>'form-control select2', 'required'=>true]
                            ) !!}
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="form-group" style="max-height: 400px; overflow-y: scroll">
                                <label>{{trans('core::group.category')}}</label>

                                    {{menuAddInRole($categories)}}


                            </div>
                        </div>



                </div>
                <!-- /.row -->
            </div>
            <div class="box-footer">
                <a href="/admin/group" class="btn btn-default pull-right">{{trans('core::group.cancel')}}</a>
                {!! Form::button(trans('core::group.save'), ['class' => 'btn btn-primary pull-left', 'type' => "submit"]) !!}
            </div>
            {!! Form::close() !!}
            <div class="overlay hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('js/groupUser.js')}}"></script>
@endsection
