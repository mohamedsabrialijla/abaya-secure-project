@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.featureProducts.index'),'title'=>'المنتجات المميزة']
        ]"/>
@endsection
@section('page_content')




    @component('components.ShowCard',[
   'Disname'=>'المنتجات المميزة',
   'Disinfo'=>'ادارة المنتجات المميزة',
   'add_url'=>null,
   'module'=>'products',
   'actions'=>[

   ]
   ])

        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
{{--                <form class="form-inline" id="form" style="float: right">--}}
{{--                    <div class="form-group m-form__group">--}}

{{--                        @component('components.serach.selectArr',['key'=>'status',--}}
{{--                 'text'=>'اختر الحالة',--}}
{{--                 'select'=>[1=>'مفعل',2=>'معطل']])--}}
{{--                        @endcomponent--}}
{{--                        @component('components.serach.select',['key'=>'category_id',--}}
{{--                 'text'=>'بحث حسب التصنيف',--}}
{{--                 'select'=>$categories])--}}
{{--                        @endcomponent--}}
{{--                        @component('components.serach.input',['type'=>'number','min'=>0,'inputs'=>['price_from'=>'السعر من','price_to'=>'السعر الى',]])--}}
{{--                        @endcomponent--}}
{{--                        @component('components.serach.inputwithsearch',['inputs'=>['name'=>'اسم المنتج']])--}}
{{--                        @endcomponent--}}

{{--                        <a href="{{route('system.featureProducts.index')}}"--}}
{{--                           class="{{config('layout.classes.delete')}} mb-4 ml-5">--}}
{{--                            <i class="fa fa-refresh"></i> تفريغ--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                </form>--}}
            </div>


        </div>

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
                        <th class="text-right">الإسم</th>
                        <th class="text-center">التصنيف</th>
                        <th class="text-center">المصمم</th>
                        <th class="text-center">السعر</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">تاريخ الاضافة</th>
                        <th class="text-center">الإعدادات</th>
                    </tr>
                    </thead>


                    <livewire:feature-products />
                </table>
            </div>
    @endcomponent
    <div class="modal" id="updateFeature" data-backdrop="static">

        <div class="modal-dialog">

            <div class="modal-content">


                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">تعديل</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>


                <!-- Modal body -->

                <div class="modal-body">

                    <div class="row justify-content-center">

                                @csrf
                        <div class="col-md-12">
                            <div class="col-md-4">
                                @component('components.upload_image',['name'=>'feature_image','text'=>'الصورة المميزة','hint'=>'60 * 60 بيكسل','id'=>'annotation_image'])
                                @endcomponent
                                <span class="text-danger" id="annotation_image_error"></span>
                            </div>
                            <div class="w-100"></div>
                            @component('components.input',['name'=>'annotation_ar' ,'text'=>'نص المنتج المميز بالعربية','not_req'=>true,'id'=>'annotation_ar'])
                            @endcomponent
                            <span class="text-danger" id="annotation_ar_error"></span>

                            @component('components.input',['name'=>'annotation_en' ,'text'=>'نص المنتج المميز بالانجليزية','not_req'=>true,'id'=>'annotation_en'])
                            @endcomponent
                            <span class="text-danger" id="annotation_en_error"></span>
                        </div>

                        <div class="w-100"></div>

                        <button type="button"
                                class="btn m-btn--pill m-btn--air btn-danger m-btn   " id="update-feature-product"
                                >
                            <span>تعديل</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--  @livewire('feature-products-component',["products"=>{{$out}}])--}}

@endsection

@section('custom_scripts')
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    <script>
        $(function () {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price_from: {
                        number: true
                    },
                    price_to: {
                        number: true
                    }
                }/*,
                message:{
                   title: 'يجب ادخال ارقام فقط',
                }*/
            }).init();


        });

    </script>

    <script>

        var product_id=0;
        $('.update').click(function () {

            product_id= $(this).data('id');
            let AnnotationAr = $(this).data('ar');
            let AnnotationEn = $(this).data('en');
            let feature_image = $(this).data('feature');

            // console.log(product_id, AnnotationAr, AnnotationEn, feature_image)
            console.log(feature_image);
            feature(product_id, AnnotationAr, AnnotationEn,feature_image);

        });

        function feature(product_id, AnnotationAr, AnnotationEn,feature_image) {
            $('#annotation_ar').val(AnnotationAr);
            $('#annotation_en').val(AnnotationEn);
            $('.MyImagePrivew').attr("src", feature_image);

            $("#updateFeature").modal('show');


        }
        $('#update-feature-product').click(function (e) {
            e.preventDefault();

            var annotation_ar = $('input[name=annotation_ar]');
            var annotation_en = $('input[name=annotation_en]');
            // var feature_image = $('img[csr=feature_image]');
            var feature_image =$('input[name=feature_image]').val();
            var token = '{{csrf_token()}}';

            var url = '{{route('system.featureProducts.update')}}';

            $.post(url, {
                    _token: token,
                    id: product_id,
                    feature_image: feature_image,
                    annotation_ar: annotation_ar.val(),
                    annotation_en: annotation_en.val(),
                },

                function (data, status) {
                    if (data) {
                        $("#updateFeature").modal('hide');
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

    </script>

@endsection
