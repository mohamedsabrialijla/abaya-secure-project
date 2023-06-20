@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.contacts.index'),'title'=>'تواصل معنا']
        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'تواصل معنا',
'Disinfo'=>'ادارة الاستفسارات القادمة من التطبيق',
'module'=>'contacts',
'actions'=>[
    [
        'route'=>'system.contacts.delete',
        'icon'=>config('layout.icons.delete_icon'),
        'text'=>'حذف',
        'role'=>"delete",
    ]
]
])

        @if(isset($out) && count($out) > 0)
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
                        <th class="text-center">البريد الالكتروني</th>
                        <th class="text-center">النص</th>
                        <th class="text-center">تاريخ الارسال</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($out as $o)
                        <tr id="TR_{{$o->id}}">

                            <td class="LOOPIDS">{{$loop->iteration}}</td>
                            <td style="text-align: center;vertical-align: middle;">
                                <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                    <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                                           id="che_{{$o->id}}">
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center" id="email_<?=$o->id?>"><?=$o->email?></td>
                            <td class="text-center"><?=$o->message?></td>
                            <td class="text-center"><?=$o->created_at->toDateString()?></td>
                            <td class="text-center">

                                <ul class="list-inline">
                                    @if(auth('system_admin')->user()->can('edit_contacts','system_admin'))
                                        <li>
                                            <button type="button"
                                                    class="{{config('layout.classes.warning')}} mt-2 showit"
                                                    title="اضغط لعرض التفاصيل"
                                                    data-body="<?=$o->message?>"
                                                    data-id="<?= $o->id?>"
                                                    data-toggle="modal" data-target="#show"
                                            >
                                                <i class="fa fa-laptop"></i> التفاصيل
                                            </button>
                                        </li>
                                    @endif

                                    @if(auth('system_admin')->user()->can('delete_contacts','system_admin'))
                                        <li>
                                            <button type="button"
                                                    data-id="<?= $o->id ?>"
                                                    data-url="{{route('system.contacts.delete')}}"
                                                    data-token="{{csrf_token()}}"
                                                    data-toggle="tooltip" data-theme="dark" title="حذف"
                                                    class="{{config('layout.classes.delete')}} mt-2 btn-del">
                                                <i class="fa fa-trash "></i>
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


    <div id="show" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">تفاصيل الرسال</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('system.contacts.replay')}}" id="form" method="post">
                    @csrf
                    <div class="modal-body">
                        <h4>الايميل : <span id="email">Email</span></h4>
                        <h4>التفاصيل : </h4>
                        <p id="body" style="width: 100%;word-wrap: break-word;"></p>

                        <h4 class="modal-title">ارسال رد</h4>

                        <input type="hidden" name="email" id="email2">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <textarea name="mess" required id="mess" rows="3"
                                      class="form-control m-input m-input--pill m-input--air"></textarea>
                        </div>

                        <hr>
                        <div class="contact-reply">
                            <h3>ردود سابقة: </h3>
                            <p></p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="{{config('layout.classes.cancel')}}" data-dismiss="modal">اغلاق
                        </button>
                        <button type="submit" class="{{config('layout.classes.submit')}}">ارسال رد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        $(function () {

            $(".showit").click(function () {

                var n = $('#body').text($(this).data('body'));

                $('#email').text($('#email_' + $(this).data('id')).text());
                $('#email2').val($('#email_' + $(this).data('id')).text());
                $('#id').val($(this).data('id'));
            });

            $(".replay").click(function () {
                $('#email').val($(this).data('email'));
            });

        })
    </script>

    <script>
        $(function () {
            $(".showit").click(function () {

                let tid = $(this).data('id');
                $.ajax({
                    dataType: "json",
                    type: "get",
                    url: "/admin/system/contacts/getContactReplies/" + tid,
                    success: function (data) {
                        console.log(data)
                        if (data) {
                            var container = $('.contact-reply');
                            var items = '';
                            $.each(data, function (i, val) {
                                items += '<span>' + val.reply + '</span><span class="float-right">' + val.created_at + '</span><hr>';
                            });
                            container.append(items);
                        }
                    }
                });

            });


        });//end of document ready

    </script>
@endsection
