<form method="post" action="{{route('news.news_region.store')}}" id="form-project"  enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="modal-body">

        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">{{trans('news::region_create.name')}}</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}">
            </div>


            <div class="form-group">
                <label>{{trans('news::region_create.language')}}</label>
                <select class="select2 group" style="width: 100%" name="lang_code">
                    <option value="0">{{trans('news::region_create.choice_language')}}</option>
                    <option value="vn">Tiếng Việt</option>
                    <option value="en">English</option>
                    <option value="fr">Francais</option>
                </select>
            </div>
        </div>




    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('news::region_create.close')}}</button>
        <button type="submit" class="btn btn-primary" >{{trans('news::region_create.save')}}</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2();
    });


</script>