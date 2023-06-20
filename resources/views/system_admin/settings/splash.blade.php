@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.splash.index'),'title'=>'شاشة السبلاش']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>' شاشة السبلاش',
'Disinfo'=>'تعديل بيانات شاشة السبلاش',
'add_url'=>route('system.splash.update'),
"back_url"=>'system.settings.index',
'action'=>'edit',


])

        <div class="row justify-content-center">


            <div class="col-md-6">
                @component('components.input',['data'=>@$splash_promotion_text_ar,'name'=>'splash_promotion_text_ar','text'=>'النص الترويجي عربي ','placeholder'=>'النص الترويجي عربي','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="col-md-6">
                @component('components.input',['data'=>$splash_promotion_text_en,'name'=>'splash_promotion_text_en','text'=>'النص الترويجي انجليزي','placeholder'=>'النص الترويجي انجليزي','icon'=>'fa-user-alt'])
                @endcomponent
            </div>


        </div>

        <div class="row mt-5">


            <div class="col-md-6">


                <div class="row">
                    <br/>
                    <div class="col-md-12 mt-5">

                        <div class="d-flex justify-content-end">


                            <button type="button"
                                    class="{{config('layout.classes.warning')}}  mt-2 updateSliderImage"
                                    title="اضافة صورة سبلاش جديدة"
                                    data-token="{{csrf_token()}}"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                            >
                                <i class="fa fa-gift "></i>

                                إضافة صورة جديدة
                            </button>


                        </div>
                    </div>

                </div>


                <table class="table table-hover mt-5">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>العمليات</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($splashImages as $key=>$image)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{$image->image_url}}" class="img_table" alt="">
                                {{$image->name}}

                            </td>
                            <td>
                                @if(count($splashImages)>1)
                                <button type="button"
                                        data-id="{{$image->id}}"
                                        data-url="{{route('system.splash.delete.image')}}"
                                        data-token="{{csrf_token()}}"
                                        data-toggle="tooltip" data-theme="dark" title="حذف"
                                        class="{{config('layout.classes.delete')}}  mt-2 btn-del">
                                    <i class="{{config('layout.icons.delete_icon')}}"></i>
                                    حذف
                                </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    @endcomponent




    <div class="modal" id="updatesliderModal" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"> صورة المنتج</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">


                        <div class="col-md-12">
                            @csrf
                            @component('components.upload_media',['name'=>'splash_image','text'=>'صورة السبلاش ','id'=>'splash_image'])
                            @endcomponent
                            <span class="text-danger" id="splash_image_error"></span>

                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                                class="btn m-btn--pill m-btn--air btn-primary m-btn m-btn--custom  btn-action-7 "
                                id="sliderImageUpdateBtn">
                            <span>حفظ</span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- END PAGE BASE CONTENT -->

@endsection

@section('custom_scripts')

    <script>

        $(function () {



        });

        $('.updateSliderImage').click(function () {



            slider();

        });
        function slider(product_id) {

            $("#updatesliderModal").modal('show');

            $('#sliderImageUpdateBtn').click(function (e) {
                e.preventDefault();
                var splash_image =$('input[name=splash_image]').val();
                var token = '{{csrf_token()}}';

                var url = '{{route('system.splash.add.image')}}';

                $.post(url, {
                        _token: token,
                        splash_image: splash_image,

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





