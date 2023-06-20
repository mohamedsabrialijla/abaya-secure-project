<div class="form-group @has_error($name)"  style="margin-top: 1rem;{{HELPER::endWith($name, '_en') !== false?'direction:ltr;text-align: left;':''}}" {{HELPER::endWith($name, '_en') !== false?'dir="ltr"':''}}>
    <label for="{{$name}}">{{$text}} </label>
    <textarea {{isset($not_req)?'':'required'}} name="{{$name}}" id="{{$name}}" class="form-control form-control-solid" rows="{{isset($rows)?$rows:5}}" placeholder="{{isset($placeholder)?$placeholder:$text}}">@old($name,isset($data)?$data:null)</textarea>

    @show_error($name)

</div>
