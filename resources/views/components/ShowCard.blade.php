@section('title', $Disname)
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{ $Disname }}
                <div class="text-muted pt-2 font-size-sm">{{ $Disinfo }}</div>
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="card-toolbar">

                <a href="{{ URL::previous() }}" class="{{ config('layout.classes.black') }} m-2">
                    <i class="la la-arrow-right"></i>
                    رجوع
                </a>

                @if (isset($actions) && count($actions))
                    @if (auth('system_admin')->user()->can('activate_' . $module, 'system_admin') ||
    auth('system_admin')->user()->can('delete_' . $module, 'system_admin'))
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="{{ config('layout.classes.actions') }}" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="la la-gear"></i>
                                <span>عمليات</span>
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover">
                                    @foreach ($actions as $action)
                                        @if (auth('system_admin')->user()->can($action['role'] . '_' . $module, 'system_admin'))
                                            <li class="navi-item">
                                                <a href="#" class="navi-link DoAction"
                                                    data-url="{{ route($action['route']) }}"
                                                    data-token="<?= csrf_token() ?>">
                                                    <i class="{{ $action['icon'] }}"></i>
                                                    <span class="navi-text">{{ $action['text'] }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach


                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->
                    @endif
                @endif
                @if (isset($add_url))
                    @if (auth('system_admin')->user()->can('add_' . $module, 'system_admin'))
                        @if (isset($store_id))
                            <a href="{{ route($add_url, ['storeId' => $store_id]) }}"
                                class="{{ config('layout.classes.add') }}">
                                <i class="la la-plus"></i>
                                <span>اضافة جديد</span>
                            </a>
                        @else
                            <a href="{{ route($add_url) }}" class="{{ config('layout.classes.add') }}">
                                <i class="la la-plus"></i>
                                <span>اضافة جديد</span>
                            </a>
                        @endif


                    @endif
                @endif
                @if (isset($excel))
                    @if (auth('system_admin')->user()->can('view_' . $module, 'system_admin'))
                        <a href="{{ route($excel) }}" class="{{ config('layout.classes.add') }}">
                            <i class="las la-file-excel"></i>
                            <span>تصدير اكسيل</span>
                        </a>
                    @endif
                @endif
                @if (isset($print))
                    @if (auth('system_admin')->user()->can('view_' . $module, 'system_admin'))
                        <a  onclick="window.print()" class="{{ config('layout.classes.add') }}">
                            <i class="las la-file"></i>
                            <span>طباعة</span>
                        </a>
                        {{-- <button onclick="window.print()"></button> --}}
                    @endif
                @endif
                @if (isset($add_popup_class))
                    <a href="javascript:;" class="{{ config('layout.classes.add') }} {{ $add_popup_class }}">
                        <i class="la la-plus"></i>
                        <span>اضافة جديد</span>
                    </a>
                @endif


            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="m-content">
            {{ $slot }}
        </div>
    </div>

</div>
