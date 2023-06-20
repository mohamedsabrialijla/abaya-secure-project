<div class="row justify-content-between">
    <label class="col col-form-label" for="{{$name}}">{{$text}}</label>
    <div class="col">
			<span class="switch switch-icon">
				<label>
					<input type="checkbox"  id="{{isset($id)?$id:$name}}"  name="{{$name}}" {{old($name,isset($data)?$data:null)==1?'checked="checked"':''}}/>
					<span></span>
				</label>
			</span>
    </div>

    <div class="col-12" style="text-align: center">
        @show_error($name)
    </div>
</div>
