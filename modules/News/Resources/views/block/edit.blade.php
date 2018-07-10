@extends('layouts.admin_default')
@section('title',trans('news::block_edit.title'))
@section('markdowns')
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-lte/MarkDown/demo.css')}}" />

    <script type="text/javascript" src="{{asset('/admin-lte/MarkDown/Markdown.Converter.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin-lte/MarkDown/Markdown.Sanitizer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin-lte/MarkDown/Markdown.Editor.js')}}"></script>
@endsection
@section('content')
    <style>
        img {
            max-width: 100%;
        }
    </style>
    <section class="content-header">
        <h1>
            {{trans('news::block_edit.edit')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin_home')}}"><i class="fa fa-dashboard"></i> {{trans('news::block_edit.homepage')}}</a></li>
            <li><a href="{{route('news.news_block.index')}}">{{trans('news::block_edit.list')}}</a></li>
        </ol>
    </section>


    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('news::block_edit.edit')}}</h3>
                @include('news::includes.message')

            </div>

            <div class="box-body">
                <div class ="row">
                    <div class="col-md-offset-1 col-md-9">

                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" action="{{route('news.block.update',['id'=>$block->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-md-3 control-label">{{trans('news::block_edit.name_block')}}</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="...." name="name" value="{{$block->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-md-3 control-label">{{trans('news::block_edit.key_word')}}</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="...." name="key" value="{{$block->key}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Upload Files</label>
                                    <div class="col-sm-9">
                                        <a href="{{asset('/block/filemanager/dialog.php?type=0')}}" data-fancybox data-caption="Upload file manager" class="btn btn-default iframe-btn" type="button">Upload file</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Suggest</label>
                                    <div class="col-sm-9">
                                        <label>If you want to insert your upload images or videos on code editor, you can add code like that</label>
                                        <br>
                                        <label>For example</label>
                                        <pre class="line-numbers">
                                            <code class="language-html">
                                                &lt;img src="/block/blockfiles/{Name_of_your_files.extension}" alt="Smiley face" height="..px" width="..px"/&gt;

                                                &lt;iframe width="300" height="150" controls="controls"
                                                        src="/block/blockfiles/{Name_of_your_files.extension}" type="video/mp4"&gt;
                                                &lt;/iframe&gt;
                                            </code>
                                        </pre>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="exampleInputEmail1 " class="col-md-3 control-label">{{trans('news::block_edit.content')}} (*)</label>
                                    <div class="col-md-9">
                                        <div id="wmd-button-bar"></div>
                                        <textarea class="wmd-input" name="data" id="wmd-input">{{$block->data}}</textarea>
                                        <div id="wmd-preview" class="wmd-preview"></div>
                                    </div>

                                </div>




                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info" style="left:48%;position:relative">{{trans('news::block_create.submit')}}</button>
                            </div>

                        </form>
                        <!-- /.box-footer -->


                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{asset('admin-lte/plugins/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('/js/prism.js')}}"></script>
    <script type="text/javascript">
        (function () {
            var converter1 = Markdown.getSanitizingConverter();

            converter1.hooks.chain("preBlockGamut", function (text, rbg) {
                return text.replace(/^ {0,3}""" *\n((?:.*?\n)+?) {0,3}""" *$/gm, function (whole, inner) {
                    return "<blockquote>" + rbg(inner) + "</blockquote>\n";
                });
            });

            var editor1 = new Markdown.Editor(converter1);

            editor1.run();


        })();
    </script>
    <script type="text/javascript">

        $("[data-fancybox]").fancybox({
            'width'		: 900,
            'height'	: 600,
            'type'		: 'iframe',
            'autoScale'    	: true
        });
    </script>
@endsection