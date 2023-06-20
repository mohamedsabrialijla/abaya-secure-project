@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories.index'),'title'=>'التصنيفات']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'التصنيفات',
'Disinfo'=>'تعديل بيانات تصنيف',
'add_url'=>route('system.categories.do.update',$out->id),
'back_url'=>'system.categories.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
            <div class="col-md-3">
                @component('components.upload_image',['data'=>$out->logo,'name'=>'image','text'=>'صورة التصنيف','hint'=>'60 * 60 بيكسل'])
                @endcomponent
            </div>

            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'اسم التصنيف بالعربية','placeholder'=>'ادخل اسم التصنيف بالعربية','icon'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'اسم التصنيف بالانجليزية','placeholder'=>'ادخل اسم التصنيف بالانجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>

            <div class="w-100"></div>
 
        
            <div class="col-md-6">
                <label>يرجى اضافة المنتجات </label>
               <select class="js-example-basic-multiple col-md-12" name="products[]" multiple="multiple">
                @foreach($products as $p)
                  <option @if(isset($out->product_selected) && $out->product_selected != '' && in_array($p->id,$out->product_selected)) selected @endif value="{{$p->id}}">{{$p->name}}</option>
                @endforeach
              </select>
            </div>

            <!--نملنمبلن-->
                 <!--<div class="col-md-7 d-flex flex-stack mb-12">-->
                        <!--begin::Label-->
                 <!--       <div class="me-5">-->
                 <!--           <label class="fs-6 fw-bold">قسم بعرض الصفحة</label>-->
                 <!--           <div class="fs-7 fw-bold text-muted">يتيح لك هذه الخاصية بعرض القسم كاملا بعرض الصفحة </div>-->
                 <!--       </div>-->
                        <!--end::Label-->
                        <!--begin::Switch-->
                 <!--       <label class="form-check form-switch form-check-custom form-check-solid">-->
                 <!--           <input class="form-check-input" name="full_width" type="radio" value="1" @if ($out->full_width == 1) checked="checked"-->
                 <!--           @endif >-->
                 <!--           <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">نعم</span></div>-->
                 <!--           <hr>-->
                 <!--           <input class="form-check-input" name="full_width" type="radio" value="0" @if ($out->full_width == 0) checked="checked"-->
                 <!--           @endif>-->
                 <!--           <div class="flipthis-wrapper"><span class="form-check-label fw-bold text-muted">لا</span></div>-->
                 <!--       </label>-->
                        <!--end::Switch-->
                 <!--   </div>-->


               
        </div>


    @endcomponent

 





    <!-- END PAGE BASE CONTENT -->

@endsection

@section('custom_scripts')

    <script>

        $(function () {

            $('#form').validate({

                errorElement: 'div', //default input error message container

                errorClass: 'abs_error help-block has-error',

            }).init();

        })


 

$(".js-example-basic-multiple").select2({
    placeholder: "يرجى اضافة المنتجات",
    allowClear: true
});

    </script>



@endsection





