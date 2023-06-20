@section('title', $Disname)
<form action="{{$add_url}}" id="form" method="post">
    @csrf
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">{{$Disname}}
                    <div class="text-muted pt-2 font-size-sm">{{$Disinfo}}</div>
                </h3>
            </div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <a href="{{route($back_url)}}" class="{{config('layout.classes.cancel')}} ml-7">
                        <i class="la la-times"></i>
                        <span>الغاء</span>
                    </a>


                    @if($action == 'add')
                        <button type="submit" class="{{config('layout.classes.submit')}}">
                            <i class="la la-check"></i>
                            <span>اضافة</span>
                        </button>

                    @else
                        <button type="submit" class="{{config('layout.classes.submit')}}">
                            <i class="la la-edit"></i>
                            <span>تعديل</span>
                        </button>

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

</form>
