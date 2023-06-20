@if (config('layout.extras.user.dropdown.style') == 'light')
    {{-- Header --}}
    <div class="d-flex align-items-center p-8 rounded-top">
        {{-- Symbol --}}
        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
            <img src="{{Auth::guard('system_admin')->user()->image_url}}" alt=""/>
        </div>

        {{-- Text --}}
        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">Sean Stone</div>
        <span class="label label-light-success label-lg font-weight-bold label-inline">3 messages</span>
    </div>
    <div class="separator separator-solid"></div>
@else
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        <div class="d-flex align-items-center mr-2">
            {{-- Symbol --}}
            <div class="symbol symbol-md mr-3 flex-shrink-0">
                <img src="{{Auth::guard('system_admin')->user()->image_url}}" alt=""/>
            </div>
            {{-- Text --}}
            <div class="text-white m-0 flex-grow-1 mr-3 font-size-h5">{{Auth::guard('system_admin')->user()->name}}</div>
        </div>
    </div>
@endif

{{-- Nav --}}
<div class="navi navi-spacer-x-0 pt-5">
    {{-- Item --}}
    <a href="{{route('system.admin.profile')}}" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-calendar-3 text-success"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    بياناتي
                </div>
                <div class="text-muted">
                    بيانات الحساب الشخصية
                    <span class="label label-light-danger label-inline font-weight-bold">تحديث</span>
                </div>
            </div>
        </div>
    </a>

    {{-- Item --}}


    {{-- Item --}}
{{--    <a href="#"  class="navi-item px-8">--}}
{{--        <div class="navi-link">--}}
{{--            <div class="navi-icon mr-2">--}}
{{--                <i class="flaticon2-rocket-1 text-danger"></i>--}}
{{--            </div>--}}
{{--            <div class="navi-text">--}}
{{--                <div class="font-weight-bold">--}}
{{--                    My Activities--}}
{{--                </div>--}}
{{--                <div class="text-muted">--}}
{{--                    Logs and notifications--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </a>--}}

    {{-- Item --}}


    {{-- Footer --}}
    <div class="navi-separator mt-3"></div>
    <div class="navi-footer  px-8 py-5">
        <a href="{{route('system_admin.logout')}}" class="btn btn-light-primary font-weight-bold">تسجيل خروج</a>
    </div>
</div>
