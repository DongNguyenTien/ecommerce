

            <div class="modal-body">
                @if(!$categories->isEmpty())
                    <p>{{trans('news::region_checkDelete.yes')}}</p>
                    @foreach($categories as $category)
                        <p>- {{$category->name}}</p>
                        @endforeach
                    <p>{{trans('news::region_checkDelete.cannot')}}</p>
                    @else <p>{{trans('news::region_checkDelete.no')}}</p>
                <p>{{trans('news::region_checkDelete.can')}}</p>

                @endif

            </div>
            <div class="modal-footer">

            @if($categories->isEmpty())
                    <button class="btn btn-default"><a href="{{route('news.news_region.delete',$data)}}">{{trans('news::region_checkDelete.closeAndDelete')}}</a></button>
                @else
                    <button class="btn btn-default" data-dismiss="modal">{{trans('news::region_checkDelete.close')}}</button>
            @endif
{{--            <a class="btn btn-default" data-dismiss="modal"> @if(!$categories->isEmpty()) @endif >Đóng</a>--}}

        </div>

            {{--<script>--}}
                {{--$('span').attr('style','display:none');--}}
            {{--</script>--}}




