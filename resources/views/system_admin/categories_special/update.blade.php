@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.categories_special.index'),'title'=>'التصنيفات']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'التصنيفات',
'Disinfo'=>'تعديل بيانات تصنيف',
'add_url'=>route('system.categories_special.do.update',$out->id),
'back_url'=>'system.categories_special.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
            <div class="col-md-3">
                @component('components.upload_image',['data'=>$out->logo,'name'=>'image','text'=>'صورة التصنيف','hint'=>'235 * 1110 بيكسل'])
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
//  klfsjkfgjs
// sdjkgsjkg
// nbsdfbgsfk

$(".js-example-basic-multiple").select2({
    placeholder: "يرجى اضافة المنتجات",
    allowClear: true
});


    </script>



@endsection





