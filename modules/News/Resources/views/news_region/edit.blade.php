<form method="post" action="{{route('news.news_region.update',['id'=>$data->id])}}" id="form-project"  enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal-body">

        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">{{trans('news::region_edit.name')}}</label>
                <input type="text" class="form-control" name="name" value="{{$data->name}}">
            </div>


            <div class="form-group">
                <label>{{trans('news::region_edit.language')}}</label>
                <select class="select2 group" style="width: 100%" name="lang_code">
                    <option value="0" >{{trans('news::region_edit.choice_language')}}</option>
                    <option value="vn" @if($data->lang_code=='vn') selected="selected" @endif>Tiếng Việt</option>
                    <option value="en" @if($data->lang_code=='en') selected="selected" @endif>English</option>
                    <option value="fr" @if($data->lang_code=='fr') selected="selected" @endif>Francais</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('news::region_edit.close')}}</button>
        <button type="submit" class="btn btn-primary" >{{trans('news::region_edit.save')}}</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2();
    });

</script>