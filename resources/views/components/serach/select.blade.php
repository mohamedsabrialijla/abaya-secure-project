<div class="input-group mr-2">
    <select name="{{$key}}" style="min-width: 150px;" class="autoSubmit" id="{{$key}}" >
        <option value="-1" {{request()->$key == -1?'selected':''}} {{--{{HELPER::set_if($_GET[$key],-1) == -1?'selected':''}}--}}>{{$text}}</option>
        @foreach($select as $r)
            <option value="{{$r->id}}" {{request()->$key == $r->id?'selected':''}} {{--{{HELPER::set_if($_GET[$key]) == $r->id?'selected':''}}--}}>{{$r->name}}</option>
        @endforeach

    </select>
</div>
