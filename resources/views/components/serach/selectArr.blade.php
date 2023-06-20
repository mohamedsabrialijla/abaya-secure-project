<div class="input-group mr-2">
    <select name="{{$key}}" style="min-width: 150px"  class="autoSubmit" id="{{$key}}" >
        <option value="-1" {{HELPER::set_if($_GET[$key],-1) == -1?'selected':''}}>{{$text}}</option>
        @foreach($select as $k=>$r)
            <option value="{{$k}}" {{HELPER::set_if($_GET[$key],-1) == $k?'selected':''}}>{{$r}}</option>
        @endforeach

    </select>
</div>
