@if ($errors->any())
    <div class="alert alert-danger" style="text-align: center;">
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
@endif