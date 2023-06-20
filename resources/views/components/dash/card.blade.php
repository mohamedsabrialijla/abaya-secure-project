<div class="{{isset($col)?'col-md-'.$col:'col'}}">
    <a href="{{$url}}" class="card card-custom bg-dark bg-hover-state-dark card-stretch gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            @if(isset($icon))
                @if(\App\Classes\Theme\Metronic::isSVG($icon))
                    <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
                     {{ Metronic::getSVG($icon) }}
                </span>
                @else

                    <i class="{{$icon}} fa-3x text-inverse-danger"></i>

                @endif
            @else
                <span class="svg-icon svg-icon-white svg-icon-3x ml-n1">

                    {{ Metronic::getSVG('media/svg/icons/General/Settings-2.svg') }}
                </span>
            @endif


            <div class="text-inverse-danger font-weight-bolder font-size-h5 mb-2 mt-5">{{$name}}</div>
            @if(isset($count) && $name == ' الطلبات  ملغي')
                <div class="font-weight-bold text-inverse-danger font-size-sm">{{$count}} </div>
            @endif 
            
             @if(isset($count) && $name != ' الطلبات  ملغي')
                <div class="font-weight-bold text-inverse-danger font-size-sm">{{$count}}</div>
            @endif
        </div>
        <!--end::Body-->
    </a>
</div>

