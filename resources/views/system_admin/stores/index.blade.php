@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.stores.index'), 'title' => 'المصممون'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard', [
        'Disname' => 'المصممون',
        'Disinfo' => 'ادارة المصممون',
        'add_url' => 'system.stores.create',
        'excel' => 'storesexport',
        'module' => 'stores',
        'actions' => [
        [
        'route' => 'system.stores.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.stores.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.stores.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        ],
        ])
        <div class="row">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'مفعل', 2 => 'معطل']])
                        @endcomponent
                        @component('components.serach.input', ['inputs' => ['mobile' => 'بحسب الجوال']])
                        @endcomponent
                        @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'بحسب الاسم']])
                        @endcomponent
                        <a href="{{ route('system.stores.index') }}" class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div>

            <div class="col-lg-12">

                @if (isset($out) && count($out) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>


                                    <th>الترتيب</th>
                                    <th width="5%" style="text-align: center;vertical-align: middle;">
                                        <label class="checkbox checkbox-outline justify-content-center checkbox-success">
                                            <input type="checkbox" id="SelectAll">
                                            <span></span>
                                        </label>

                                    </th>

                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">التواصل</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">عدد المنتجات</th>
                                    <th class="text-center">تاريخ التسجيل</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out as $o)
                                   
                                   
                                    <tr id="TR_{{ $o->id }}">

                                        <td class="LOOPIDS">{{ $o->ordering }}</td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_{{ $o->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <img src="{{ $o->image }}" class="img_table" alt="">

                                        </td>
                                        <td class="text-center">
                                            <p> {{ @$o->name_ar }}</p>
                                            <p> {{ @$o->name_en }}</p>
                                        </td>


                                        <td class="text-center">
                                            @if ($o->mobile)
                                                جوال : {{ $o->mobile }}
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if ($o->status == 1)
                                                <span class="m--font-success"> مفعل </span>
                                            @elseif($o->status == 2)
                                                <span class="m--font-warning"> غير مفعل </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                <a
                                                    href="{{ route('system.products.index') }}?store_id={{ $o->id }}">{{ @$o->products()->count() }}</a>
                                            </p>
                                        </td>
                                        <td class="text-center"> {{ @$o->created_at->toDateString() }}</td>
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{ route('system.products.store', ['storeId' => $o->id]) }}"
                                                        class=" {{ config('layout.classes.warning') }} mt-2 "
                                                        title="عرض المنتجات" data-toggle="tooltip" data-theme="dark"
                                                        data-placement="top">
                                                        <i class="fa fa-box"></i> عرض المنتجات
                                                    </a>

                                                </li>
                                                <a href="{{ route('system.stores.view', ['store' => $o->id]) }}"
                                                    class="{{ config('layout.classes.warning') }}  mt-2">
                                                    <i class="fa fa-eye"></i>
                                                    تفاصيل
                                                </a>
                                                @if (auth('system_admin')->user()->can('view_oustores', 'system_admin'))
                                                @endif
                                                {{-- <li> --}}
                                                {{-- <button type="button" --}}
                                                {{-- class="{{config('layout.classes.warning')}}  mt-2 show-designer-details" --}}
                                                {{-- title="تفاصيل" --}}
                                                {{-- data-url="{{route('system.stores.show')}}" --}}
                                                {{-- data-token="{{csrf_token()}}" --}}
                                                {{-- data-id="<?= $o->id ?>" --}}
                                                {{-- data-toggle="tooltip" --}}
                                                {{-- data-theme="dark" --}}
                                                {{-- data-placement="top" --}}

                                                {{-- > --}}
                                                {{-- <i class="fa fa-eye"></i> تفاصيل --}}
                                                {{-- </button> --}}

                                                {{-- </li> --}}
                                                {{-- @endif --}}
                                                @if (auth('system_admin')->user()->can('edit_stores', 'system_admin'))
                                                <li>
                                                    <a href="{{ route('system.stores.update', $o->id) }}"
                                                        class="{{ config('layout.classes.edit') }} mt-2"
                                                        data-toggle="tooltip" data-theme="dark" title="تعديل البيانات">
                                                        <i class="fa fa-edit"></i> تعديل </a>
                                                </li>
                                                    <li>
                                                        <a href="{{ route('system.stores.sales', ['id' => $o->id]) }}"
                                                            class="{{ config('layout.classes.edit') }} mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="المبيعات">
                                                            <i class="fa fa-money-bill"></i> المبيعات </a>
                                                    </li>
                                                @endif

                                                @if (auth('system_admin')->user()->can('delete_stores', 'system_admin'))
                                                    @if ($o->can_del)
                                                        <li>
                                                            <button type="button" data-id="<?= $o->id ?>"
                                                                data-url="{{ route('system.stores.delete') }}"
                                                                data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                                data-theme="dark" title="حذف"
                                                                class="{{ config('layout.classes.delete') }} mt-2 btn-del">
                                                                <i class="{{ config('layout.icons.delete_icon') }}"></i>
                                                                حذف
                                                            </button>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <button type="button" data-toggle="tooltip" data-theme="dark"
                                                                title="لا يمكن حذف المصمم لوجود منتجات تابعة له"
                                                                class="{{ config('layout.classes.delete') }} mt-2 disabled">
                                                                <i class="fa fa-trash "></i>
                                                                حذف
                                                            </button>
                                                        </li>
                                                    @endif
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

    <div class="modal  " id="designer-modal" data-backdrop="static">

        <div class="modal-dialog  modal-dialog-centered modal-lg">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"> تفاصيل المصمم</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">




                </div>

            </div>

        </div>

    </div>

@endsection

@section('custom_scripts')
    <script>
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
        $('.show-designer-details').click(function() {


            let id = $(this).data('id');

            var token = '<?= csrf_token() ?>';

            var url = $(this).data('url');

            $.get(url, {
                    _token: token,
                    id: id,
                },
                function(data, status) {
                    if (data) {
                        $("#designer-modal .modal-body").html(data.details);
                        $("#designer-modal").modal('show');

                    } else {

                        Swal.fire("تنبيه", "يوجد خطأ ما", "warning")

                    }

                });
        });
    </script>


    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_ar'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "ar",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                    );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#return_policy_en'), {

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'fontSize',
                        'fontColor',
                        'alignment',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'exportPdf',
                        'exportWord'
                    ]
                },
                language: "en",
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },

                licenseKey: '',

            })
            .then(editor => {
                window.editor = editor;
                editor.isReadOnly = true;







            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                    );
                console.warn('Build id: xcs2esji16m9-tqzhsy8f19xk');
                console.error(error);
            });
    </script>
@endsection
