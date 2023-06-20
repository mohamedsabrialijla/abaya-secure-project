@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.coupons.index'), 'title' => 'كبونات الخصم'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard',
        [
            'Disname' => 'كبونات الخصم',
            'Disinfo' => 'ادارة كبونات الخصم',
            'add_url' => 'system.coupons.create',
            'module' => 'coupons',
            'actions' => [
                [
                    'route' => 'system.coupons.activate',
                    'icon' => config('layout.icons.activate_icon'),
                    'text' => 'تفعيل',
                    'role' => 'activate',
                ],
                [
                    'route' => 'system.coupons.deactivate',
                    'icon' => config('layout.icons.deactivate_icon'),
                    'text' => 'تعطيل',
                    'role' => 'activate',
                ],
                [
                    'route' => 'system.coupons.delete',
                    'icon' => config('layout.icons.delete_icon'),
                    'text' => 'حذف',
                    'role' => 'delete',
                ],
            ],
        ])
        <div class="row">

            <div class="row">
                <div class="col">
                    <form class="form-inline" id="form" style="float: right">
                        <div class="form-group m-form__group">
                            <div class="input-group">
                                @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 => 'مفعل', 0 => 'معطل']])
                                @endcomponent
                                {{-- @component('components.serach.select', ['key' => 'store_id', 'text' => 'بحث حسب المصمم', 'select' => $stores])
                                @endcomponent --}}

                                @component('components.serach.dateRanger')
                                @endcomponent

                                @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'الكود']])
                                @endcomponent

                                <a href="{{ route('system.coupons.index') }}"
                                    class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                                    <i class="fa fa-refresh"></i> تفريغ
                                </a>

                            </div>
                        </div>


                    </form>
                </div>
            </div>

            <div class="col-lg-12">
                @if (isset($out) && count($out) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="5%" style="text-align: center;vertical-align: middle;">
                                        <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                            <input type="checkbox" id="SelectAll">
                                            <span></span>
                                        </label>

                                    </th>
                                    <th class="text-center">الكود</th>
                                    <th class="text-center">نوع الخصم</th>
                                    <th class="text-center">قيمة الخصم</th>
                                    <th class="text-center">تاريخ البداية</th>
                                    <th class="text-center">تاريخ الانتهاء</th>
                                    <th class="text-center">مرات الاستخدام المسموح </th>
                                    <th class="text-center">مرات الاستخدام </th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">الاعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out as $o)
                                    <tr id="TR_{{ $o->id }}">

                                        <td class="LOOPIDS">
                                            {{ ($out->currentpage() - 1) * $out->perpage() + $loop->iteration }}</td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_{{ $o->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->code }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if ($o->flag == 1)
                                                <p> نسبة مئوية</p>
                                            @elseif ($o->flag == 2)
                                                <p> مبلغ محدد</p>
                                            @elseif ($o->flag == 3)
                                                <p> خصم قيمة الشحن</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->discount_ratio }} </p>

                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->start_date->toDateString() }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->expire_date->toDateString() }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->count_of_use }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->used_count }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if ($o->is_active == 1)
                                                <span class="m--font-success"> مفعل </span>
                                            @else
                                                <span class="m--font-warning"> معطل </span>
                                            @endif
                                        </td>
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                @if (auth('system_admin')->user()->can('edit_coupons', 'system_admin'))
                                                <li>
                                                    <a href="{{ route('system.coupons.orders', $o->id) }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="الطلبات">
                                                        <i class="fa fa-eye"></i> الطلبات </a>
                                                </li>
                                            @endif

                                                @if (auth('system_admin')->user()->can('edit_coupons', 'system_admin'))
                                                    <li>
                                                        <a href="{{ route('system.coupons.update', $o->id) }}"
                                                            class="{{ config('layout.classes.edit') }} mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="تعديل">
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>
                                                @endif
                                                @if (auth('system_admin')->user()->can('delete_coupons', 'system_admin'))
                                                    <li>

                                                        <button class="{{ config('layout.classes.delete') }} mt-2 btn-del"
                                                            data-id="<?= $o->id ?>" data-toggle="tooltip" data-theme="dark"
                                                            data-url="{{ route('system.coupons.delete') }}"
                                                            data-token="{{ csrf_token() }}" title="حذف"><i
                                                                class="fa fa-trash"> </i>حذف
                                                        </button>

                                                    </li>
                                                @endif
                                            </ul>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {!! $out->links() !!}
                @else
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                @endif

            </div>
        </div>
    @endcomponent


@endsection
