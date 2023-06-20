<div class="input-group mr-2">
    @foreach($inputs as $key=>$text)
        <input type="text" name="{{$key}}" class="form-control m-input m-input--pill" style="border-radius: 0" value="{{--{{HELPER::set_if($_GET[$key])}}--}}{{request()->$key}}"  placeholder="{{$text}}">

    @endforeach
   <div class="input-group-append">
        <button class="{{config('layout.classes.black')}}" type="submit"><i class="fa fa-search"></i></button>
    </div>
</div>
