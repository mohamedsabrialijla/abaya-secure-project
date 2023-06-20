@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.users.index'), 'title' => 'الزبائن'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard', [
        'Disname' => 'الزبائن',
        'Disinfo' => 'ادارة الزبائن',
        'add_url' => null,
        'excel' => 'customersexport',
        'module' => 'users',
        'actions' => [
        [
        'route' => 'system.users.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.users.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.users.ban',
        'icon' => config('layout.icons.ban_icon'),
        'text' => 'حظر',
        'role' => 'activate',
        ],
        [
        'route' => 'system.users.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        ],
        ])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [0 =>
                            'غير مفعل', 1 => 'مفعل']])
                        @endcomponent
                        @component('components.serach.input', ['type' => 'number', 'inputs' => ['mobile' => 'بحسب الجوال']])
                        @endcomponent
                        @component('components.serach.input', ['inputs' => ['email' => 'بحسب الايميل']])
                        @endcomponent
                        @component('components.serach.inputwithsearch', [
                            'inputs' => [
                            'name' => 'بحسب الاسم',
                            ],
                            ])
                        @endcomponent
                        <a href="{{ route('system.users.index') }}" class="{{ config('layout.classes.delete') }} mb-4 mr-4">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div>


        </div>
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
                            <th class="text-center">الإسم</th>
                            <th class="text-center">البريد الإلكتروني</th>
                            <th class="text-center">رقم الجوال</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تاريخ التسجيل</th>
                            <th class="text-center">الإعدادات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($out as $o)
                            <tr id="TR_{{ $o->id }}">

                                <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                        <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                            id="che_{{ $o->id }}">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="text-center">{{ $o->name }}</td>
                                <td class="text-center"> {{ $o->email }}</td>
                                <td class="text-center"> {{ $o->mobile }}</td>

                                <td class="text-center">
                                    @if (auth('system_admin')->user()->can('activate_users', 'system_admin'))
                                        <div class="form-group" id="status_{{ $o->id }}">
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" class="change_status" name="status_{{ $o->id }}"
                                                        data-id="{{ $o->id }}" data-status="1" value="1"
                                                        {{ $o->status == 1 ? 'checked' : '' }} />
                                                    <span></span>
                                                    مفعل
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" class="change_status"
                                                        name="status_{{ $o->id }}" data-id="{{ $o->id }}"
                                                        data-status="0" value="0" {{ $o->status == 0 ? 'checked' : '' }} />
                                                    <span></span>
                                                    غير مفعل
                                                </label>

                                            </div>
                                        </div>
                                    @else
                                        @if ($o->status == 1)
                                            <span class="font-success"> مفعل </span>
                                        @elseif($o->status == 2)
                                            <span class="font-danger"> محظور </span>
                                        @elseif($o->status == 0)
                                            <span class="font-warning"> غير مفعل </span>
                                        @endif
                                    @endif
                                </td>

                                <td class="text-center"> {{ $o->created_at->toDateString() }}</td>
                                <td class="text-center">

                                    <ul class="list-inline">
                                        @if (auth('system_admin')->user()->can('view_users', 'system_admin'))
                                            <li>
                                                <a href="{{ route('system.users.details', $o->id) }}"
                                                    class="{{ config('layout.classes.edit') }} mt-2" data-toggle="tooltip"
                                                    data-theme="dark" title="عرض بيانات المستخدم">
                                                    <i class="fa fa-eye"></i> تفاصيل </a>
                                            </li>
                                        @endif

                                        @if (auth('system_admin')->user()->can('delete_users', 'system_admin'))
                                            <li>
                                                <button type="button" data-id="<?= $o->id ?>"
                                                    data-url="{{ route('system.users.delete') }}"
                                                    data-token="{{ csrf_token() }}" data-toggle="tooltip" data-theme="dark"
                                                    title="حذف" class="{{ config('layout.classes.delete') }}  mt-2 btn-del">
                                                    <i class="{{ config('layout.icons.delete_icon') }}"></i>
                                                    حذف
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
                <h4 class="block">لا يوجد بيانات للعرض</h4>
            </div>
        @endif
    @endcomponent




@endsection


@section('custom_scripts')
    <script>
        $(function() {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price_to: {
                        number: true
                    }
                }
                /*,
                                message:{
                                   title: 'يجب ادخال ارقام فقط',
                                }*/
            }).init();

        });
        $("input[name=mobile]").keyup(function() {
            if ($(this)) {
                $(this).attr({
                    'pattern': '\\d*',
                    'title': "الرجاء ادخال ارقام فقط"
                });
            }
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.change_status').change(function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                swal.fire({
                    title: "هل انت متأكد ؟",
                    text: "هل تريد بالتأكيد تغيير حالة المستخدم؟",
                    type: "warning",
                    showCancelButton: 1,
                    confirmButtonText: "نعم , قم بالتغيير !",
                    cancelButtonText: "لا, الغي العملية !",
                    reverseButtons: 1
                }).then(function(e) {
                    if (e.value) {
                        $.ajax({
                            type: "post",
                            dataType: "json",
                            url: '{{ route('system.users.change_status') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                'status': status,
                                'id': id
                            },
                            success: function(data) {

                            }
                        });
                    } else {
                        e.dismiss && swal.fire("تم الالغاء", "لم يتم عمل اي تغيير", "error");
                        location.reload();
                    }
                });

            });
        });
    </script>
@endsection
