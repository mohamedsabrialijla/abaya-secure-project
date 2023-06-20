@section('title', $Disname)
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{$Disname}}
                <div class="text-muted pt-2 font-size-sm">{{$Disinfo}}</div>
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="card-toolbar">
                @if(isset($actions) && count($actions))
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="{{config('layout.classes.actions')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-gear"></i>
                        <span>عمليات</span>
                    </button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover">
                            @foreach($actions as $action)

                                <li class="navi-item">

                                    <a href="#"
                                       class="navi-link DoAction"
                                       data-url="{{route($action['route'])}}"
                                       data-token="<?= csrf_token() ?>">
                                        <i class="{{$action['icon']}}"></i>
                                        <span class="navi-text">{{$action['text']}}</span>
                                    </a>
                                </li>


                            @endforeach


                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                @endif
                @if(isset($add_url))
                            <a href="{{route($add_url)}}" class="{{config('layout.classes.submit')}}">
                                <i class="la la-check"></i>
                                <span>حفظ</span>
                            </a>
                @endif

            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="m-content">
            {{$slot}}
        </div>
    </div>

</div>
