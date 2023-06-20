@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>'','title'=>'صور سلايدر الموقع'],

        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'لاندينج بيج',
'Disinfo'=>'ادارة صور السلايدر',
'add_url'=>'',
'add_popup_class'=>'updateSliderImage',
'module'=>'sliders',
'actions'=>[

       [
            'route'=>'system.slider.destroy',
            'icon'=>config('layout.icons.delete_icon'),
            'text'=>'حذف',
            'role'=>"delete",
        ]

   ]
])
        <div class="row">
            <div class="col-lg-12">
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

                                <th class="text-center">الصورة</th>

                                <th class="text-center">الاعدادات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($out as $o)
                                <tr id="TR_{{$o->id}}">

{{--                                    <td class="LOOPIDS">{{($out ->currentpage()-1) * $out ->perpage() + $loop->iteration}}</td>--}}
                                    <td class="LOOPIDS">{{ $loop->iteration}}</td>
                                    <td style="text-align: center;vertical-align: middle;">
                                        <label
                                            class="checkbox checkbox-outline checkbox-success justify-content-center">
                                            <input type="checkbox" value="{{$o->id}} " name="Item[]"
                                                   class="CheckedItem"
                                                   id="che_{{$o->id}}">
                                            <span></span>
                                        </label>
                                    </td>

                                    <td class="text-center">
                                        <img src="{{$o->image_url}}" alt="sliderImage" width="150"/>
                                    </td>

                                    <td class="text-center">

                                        <ul class="list-inline">
                                            <li>
                                                <button type="button"
                                                        data-id="{{$o->id}}"
                                                        data-url="{{route('system.slider.destroy')}}"
                                                        data-token="{{csrf_token()}}"
                                                        data-toggle="tooltip" data-theme="dark" title="حذف"
                                                        class="{{config('layout.classes.delete')}}  mt-2 btn-del">
                                                    <i class="{{config('layout.icons.delete_icon')}}"></i>
                                                    حذف
                                                </button>
                                            </li>


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
    <div class="modal" id="updatesliderModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">اضافة صورة لسلايدر الموقع</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">
                            @csrf
                            @component('components.upload_image',['name'=>'slider_image','text'=>'صورة شريحة السلايدر ','id'=>'slider_image'])
                            @endcomponent
                            <span class="text-danger" id="slider_image_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                                class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom  btn-action-7 "
                                id="sliderImageUpdateBtn">
                            <span> اضافة </span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('custom_scripts')
    <script>
        $('.updateSliderImage').click(function () {




            slider();

        });
        function slider() {

            $("#updatesliderModal").modal('show');

            $('#sliderImageUpdateBtn').click(function (e) {
                e.preventDefault();
                var slider_image =$('input[name=slider_image]').val();
                var token = '{{csrf_token()}}';

                var url = '{{route('system.slider.store')}}';

                $.post(url, {
                        _token: token,
                        image: slider_image,

                    },

                    function (data, status) {
                        if (data) {
                            $("#updatesliderModal").modal('hide');
                            location.reload();
                        } else {
                            alert('هناك خطأ ما');
                        }
                    })
                    .fail(function (data) {
                        var response = $.parseJSON(data.responseText);

                        $.each(response.errors, function (key, value) {
                            $('#' + value.field).css('border-color', '#F64E60');
                            $('#' + value.field + '_error').text(value.error);

                        });//end each
                    });

            });
        }
    </script>
@endsection
