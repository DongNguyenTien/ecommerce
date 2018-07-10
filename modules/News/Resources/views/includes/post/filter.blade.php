<div class="row">
    <div class="col-md-5">
        <div class="form-group no-margin remove-date">
            <label>{{trans('news::filter.title')}}</label>
            <input id="title" name="name" type="text" class="form-control" value="{{ Request::get('name') }}" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group no-margin remove-date">
            <label>{{trans('news::filter.published_at')}}</label>
            <div class='input-group date'>
                <input type='text' class="form-control" id="datetimepicker1" name="published_at"  value="{{ Request::get('published_at') }}" onchange="return filter()" />
                {{--<span class="input-group-addon">--}}
                    {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                {{--</span>--}}
                <label class="input-group-addon btn" for="date">
                    <span class="fa fa-calendar open-datetimepicker"></span>
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-3 pull-right">
        <div class="form-group">
            <label style="visibility: hidden">TK</label>
            <button type="submit" class="btn btn-primary btn-block" onclick="return filter()"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span> {{trans('news::filter.search')}}</button>
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group no-margin remove-date">
            <label>{{trans('news::filter.category')}}</label>
            <select class="form-control select2" id="category" name="category" data-placeholder="{{trans('news::filter.choose_category')}}" onchange="return filter()">
                <option value="-1">{{trans('news::filter.category_all')}}</option>
                @foreach($listCategory as $val)
                    {{--@if($val->id > 0)--}}
                    <option value="{{$val['id']}}" {{(Request::get('category') == $val['id'] ? 'selected':'')}}>{{$val['name']}}</option>
                    {{--@endif--}}
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group no-margin remove-date">
            <label>{{trans('news::filter.post_status')}}</label>
            <select class="form-control select2" id="post_status" name="post_status" data-placeholder="{{trans('news::filter.post_status')}}" onchange="return filter()">
                <option value="-1">{{trans('news::filter.post_status_all')}}</option>
                <option value="0" {{(Request::get('post_status') === 0 ? 'selected':'')}}>Draft</option>
                <option value="1" {{(Request::get('post_status') == 1 ? 'selected':'')}}>Release</option>
            </select>
        </div>
    </div>
    {{--<div class="col-md-3">--}}
        {{--<div class="form-group no-margin remove-date">--}}
            {{--<label>{{trans('news::filter.tag')}}</label>--}}
            {{--<select class="form-control select2" id="tag" name="tag" data-placeholder="{{trans('news::filter.choose_tag')}}" onchange="return filter()">--}}
                {{--<option value="-1">{{trans('news::filter.tag_all')}}</option>--}}
            {{--@foreach($tags as $val)--}}
                {{--<option value="{{$val->name}}" {{(Request::get('tag') == $val->name ? 'selected':'')}}>{{$val->name}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
    {{--</div>--}}

</div>