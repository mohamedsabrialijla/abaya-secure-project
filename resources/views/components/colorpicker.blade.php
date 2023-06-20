<div class="form-group m-form__group  @has_error('{{$name}}')">
    <label for="{{$name}}">{{$text}} </label>
    <div class="m-input-icon m-input-icon--left m-input-icon--right">
        <input class="form-control" type="color" {{isset($not_req)?'':'required'}} name="{{$name}}"
               value="@old($name,isset($data)?$data:null)" id="{{$name}}">
    </div>
    @show_error($name)

</div>
