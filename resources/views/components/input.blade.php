



    <div class="form-group  @has_error($name)" style="{{HELPER::endWith($name, '_en') !== false?'direction:ltr;text-align: left;':''}}">
        <label for="{{$name}}">{{$text}}<span id="{{$name.'_related'}}" style="display: none;"></span></label>

        <div class="input-group input-group-solid">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="{{isset($icon_pre)?$icon_pre:'fa'}} {{isset($icon)?$icon:'fa-desktop'}} icon-lg"></i>
                </span>
            </div>

            <input

                @if(isset($type))
                @if($type == 'date')
                data-provide="datepicker"
                type="text"
                @if(isset($startDate))
                data-date-start-date="{{$startDate}}"
                @else
                data-date-start-date="{{\Carbon\Carbon::now()->subYears(10)->toDateString()}}"
                @endif
                @else
                type="{{$type}}"
                @endif
                @if($type == "password")
                autocomplete="off"
                @endif
                @else
                type="text"

                @endif

                @if(isset($min))
                    min="{{$min}}"
                @endif
                class="form-control {{@$class}}" placeholder="{{isset($placeholder)?$placeholder:$text}}"
                {{isset($not_req)?'':'required'}} name="{{$name}}" value="@old($name,isset($data)?$data:null)" id="{{$name}}" />

        </div>
        <span class="form-text text-muted">{{isset($hint)?$hint:""}}</span>
        @show_error($name)
    </div>



