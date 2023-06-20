@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.notifications.index'), 'title' => 'الاشعارات'],
    ]" />
@endsection
@section('head')
    <link rel="stylesheet" href="{{ asset('admin/onesignal-emoji/css/emoji.css') }}">
    <style>
        .emoji-menu .emoji-items a {
            margin: -1px 0 0 -1px;
            padding: 6px;
            display: block;
            float: right;
            border-radius: 2px;
            border: 0;
        }
    </style>
@endsection
@section('page_content')


    @component('components.AddEditCard',
        [
            'Disname' => 'الاشعارات',
            'Disinfo' => 'اضافة اشعار جديد',
            'add_url' => route('system.notifications.do.create'),
            'back_url' => 'system.notifications.index',
            'action' => 'add',
        ])
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="form-group @has_error('title')">
                            <label for="title">العنوان</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control" data-emojiable="true" placeholder="العنوان" required
                                    name="title_with_imoje" value="@old('title_with_imoje')" id="title">
                            </div>
                            @show_error('title')

                        </div>

                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group @has_error('name')">
                            <label for="name">إضافة اسم العميل لعنوان الاشعار</label>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="name" type="radio" value="0" checked="checked">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>
                                <br>
                                <input class="form-check-input" name="name" type="radio" value="1">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>
                            </label>
                            @show_error('name')

                        </div>

                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group  @has_error('message')">
                            <label for="message">نص الاشعار </label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control" data-emojiable="true" placeholder="نص الاشعار"
                                    required name="message_with_imoje" value="@old('message_with_imoje')" id="message">
                                {{-- <span class="m-input-icon__icon m-input-icon__icon--left"><span><i class="fa fa-list-alt"></i></span></span> --}}
                            </div>
                            @show_error('message')

                        </div>


                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group @has_error('user_query')">
                            <label for="user_query">الفئة المستهدفة</label>
                            <div class="m-input-icon m-input-icon--left m-input-icon--right">
                                <div class="input-group">
                                    <select style="width: 100%;" name="user_query" id="user_query" required>
                                        <option value="0">الكل</option>
                                        <option value="1">حسابات غير مفعلة</option>
                                        <option value="2">حسابات بدون طلبات</option>
                                        {{-- <option value="3">مستخدمين</option> --}}

                                    </select>
                                </div>
                            </div>
                            @show_error('user_query')

                        </div>


                    </div>
                    {{-- <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group @has_error('schedule')">
                            <label for="name">جدولة الأشعار</label>
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" name="schedule" type="radio" value="0" checked="checked">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>
                                <br>
                                <input class="form-check-input" name="schedule" type="radio" value="1">
                                <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>
                            </label>
                            @show_error('schedule')

                        </div>

                    </div> --}}
                    {{-- <div class="w-100"></div>
                    <div class="col">
                        <div class="form-group  @has_error('schedule_date')">
                            <label for="schedule_date">تاريخ الجدولة </label>
                            <div class="input-group input-group-solid">
                                <input type="datetime-local" class="form-control" name="schedule_date" >
                            </div>
                            @show_error('schedule_date')

                        </div>


                    </div> --}}
                    {{-- <div class="col Users" style="display: none">
                        @component('components.select', ['name' => 'user_ids[]', 'text' => 'المستخدمين', 'select' => $users])
                        @endcomponent
                    </div> --}}
                </div>

            </div>
        </div>
    @endcomponent


@endsection





@section('custom_scripts')
    <script src="{{ asset('admin/onesignal-emoji/js/config.js') }}"></script>
    <script src="{{ asset('admin/onesignal-emoji/js/util.js') }}"></script>
    <script src="{{ asset('admin/onesignal-emoji/js/jquery.emojiarea.js') }}"></script>
    <script src="{{ asset('admin/onesignal-emoji/js/emoji-picker.js') }}"></script>
    <script>
        $(function() {

            $('#form').validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();
            $('#user_query').on('change', function() {
                let val = $(this).val();
                if (val == 3) {
                    $('.Users').show();
                } else {
                    $('.Users').hide();
                }
            })

        });
        $(function() {
            $(function() {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                    emojiable_selector: '[data-emojiable=true]',
                    assetsPath: '{{ asset('admin/onesignal-emoji/img') }}',
                    popupButtonClasses: 'fa fa-smile'
                });
                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
                // It can be called as many times as necessary; previously converted input fields will not be converted again
                window.emojiPicker.discover();
                $('.emoji-picker-icon').css('top', '20px');
                $('.emoji-picker-icon').css('font-size', '1.8rem');
                $('.emoji-picker-icon').css('opacity', '0.4');
                $('.emoji-menu .emoji-items-wrap').css('height', '170px');
                $('.emoji-menu .emoji-items-wrap').css('overflow-y', 'auto');
                $('.emoji-menu .emoji-items-wrap').css('overflow-x', 'hidden');
            });
        });
    </script>
    <script type="text/javascript">
        // document.getElementById('MYimage_uploaded_file').addEventListener('change', readURL, true);
        // function readURL(){
        //
        //     var file = document.getElementById("MYimage_uploaded_file").files[0];
        //     var reader = new FileReader();
        //     reader.onloadend = function(){
        //         document.getElementById('MyImagePrivew').src =  reader.result ;
        //         document.getElementById('uploaded_image_name').value =  reader.result ;
        //
        //     }
        //     if(file){
        //         reader.readAsDataURL(file);
        //     }else{
        //     }
        // }
    </script>
@endsection
