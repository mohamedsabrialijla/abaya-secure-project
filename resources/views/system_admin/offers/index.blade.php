@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.offers.index'), 'title' => 'العروض'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard', [
        'Disname' => 'العروض',
        'Disinfo' => 'ادارة العروض',
        'add_url' => 'system.offers.create',
        'module' => 'stores',
        'actions' => [
        [
        'route' => 'system.offers.delete',
        'icon' => config('layout.icons.delete_icon'),
        'text' => 'حذف',
        'role' => 'delete',
        ],
        ],
        ])
        <div class="row">
            {{-- <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        @component('components.serach.selectArr', ['key' => 'status', 'text' => 'اختر الحالة', 'select' => [1 =>
                            'مفعل', 2 => 'معطل']])
                        @endcomponent
                        @component('components.serach.input', ['inputs' => ['mobile' => 'بحسب الجوال']])
                        @endcomponent
                        @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'بحسب الاسم']])
                        @endcomponent
                        <a href="{{ route('system.offers.index') }}" class="{{ config('layout.classes.delete') }} mb-4 ml-5">
                            <i class="fa fa-refresh"></i> تفريغ
                        </a>
                    </div>

                </form>
            </div> --}}

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

                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">قابل للنقر</th>
                                    <th class="text-center">عدد المنتجات</th>
                                    <th class="text-center">تاريخ الاضافة</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out as $o)
                                    <tr id="TR_{{ $o->id }}">

                                        <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_{{ $o->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <img src="{{ $o->image_url }}" class="img_table" alt="">

                                        </td>

                                        <td class="text-center">
                                            @if ($o->clickable == 0)
                                                <span class="m--font-success"> لا </span>
                                            @elseif($o->clickable == 1)
                                                <span class="m--font-warning"> نعم </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <p>
                                                {{ @$o->products()->count() }}
                                            </p>
                                        </td>
                                        <td class="text-center"> {{ @$o->created_at->toDateString() }}</td>
                                        <td class="text-center">

                                            <ul class="list-inline">

                                                @if (auth('system_admin')->user()->can('view_stores', 'system_admin'))
                                                <a href="{{ route('system.offers.view', ['offer' => $o->id]) }}"
                                                    class="{{ config('layout.classes.warning') }}  mt-2">
                                                    <i class="fa fa-eye"></i>
                                                    تفاصيل
                                                </a>
                                                @endif

                                                @if (auth('system_admin')->user()->can('edit_stores', 'system_admin'))
                                                    <li>
                                                        <a href="{{ route('system.offers.update', $o->id) }}"
                                                            class="{{ config('layout.classes.edit') }} mt-2"
                                                            data-toggle="tooltip" data-theme="dark" title="تعديل البيانات">
                                                            <i class="fa fa-edit"></i> تعديل </a>
                                                    </li>
                                                @endif

                                                @if (auth('system_admin')->user()->can('delete_stores', 'system_admin'))
                                                        <li>
                                                            <button type="button" data-id="<?= $o->id ?>"
                                                                data-url="{{ route('system.offers.delete') }}"
                                                                data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                                data-theme="dark" title="حذف"
                                                                class="{{ config('layout.classes.delete') }} mt-2 btn-del">
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
