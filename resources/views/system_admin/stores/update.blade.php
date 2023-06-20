@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.stores.index'),'title'=>'المصممون'],

        ]"/>
@endsection


@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'المصممون',
'Disinfo'=>'تعديل بيانات مصمم ',
'add_url'=>route('system.stores.do.update',$out->id),
'back_url'=>'system.stores.index',
'action'=>'edit',


])
       <div class="row">
           <div class="col-10">
               <div class="row">

                   <div class="col-md-6">
                       @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم باللغة العربية','icon'=>'fa-user-alt'])
                       @endcomponent
                   </div>
                   <div class="col-md-6">
                       @component('components.input',['data'=>$out->name_en,'name'=>'name_en','text'=>'الاسم باللغة الانجليزية','placeholder'=>'ادخل الاسم باللغة الانجليزية','icon'=>'fa-user-alt'])
                       @endcomponent
                   </div>
                   <div class="w-100"></div>

                   <div class="col-md-6">
                       @component('components.input',['data'=>substr($out->mobile, 3, 12),'name'=>'mobile','text'=>'الجوال','placeholder'=>'ادخل رقم الجوال','not_req'=>true])
                       @endcomponent
                   </div>

                   <div class="col-md-6">
                    @component('components.input', ['name' => 'commission','data'=> $out->commission,'type' =>'number', 'text' => 'نسبة عمولة البرناج', 'placeholder' => '%', 'icon' => 'fa-user-alt'])
                    @endcomponent
                </div>

                   <div class="w-100"></div>
               </div>

               <div class="row">

                   <div class="col-md-4">
                       @component('components.input',['data'=>$out->whatsapp,'name'=>'whatsapp','text'=>'واتس آب','not_req'=>true , 'hint'=>'966595341355','icon'=>'fa-user-alt'])
                       @endcomponent
                   </div>
                   <div class="col-md-4">
                       @component('components.input',['data'=>$out->instagram,'name'=>'instagram','text'=>'انستاجرام','not_req'=>true , 'hint'=>'username','icon'=>'fa-user-alt'])
                       @endcomponent
                   </div>

                   <div class="col-md-4">
                       @component('components.input',['data'=>$out->snapchat,'name'=>'snapchat','text'=>'سناب شات','not_req'=>true , 'hint'=>'username','icon'=>'fa-user-alt'])
                       @endcomponent
                   </div>
                   <div class="w-100"></div>


                   <div class="w-100"></div>
               </div>

               <div class="row">
                   <div class="col-md-12">
                       @component('components.area_editor',['data'=>$out->return_policy_ar,'name'=>'return_policy_ar','text'=>'سياسة الارجاع باللغة العربية '])
                       @endcomponent
                   </div>
                   <div class="w-100"></div>
                   <div class="col-md-12">
                       @component('components.area_editor',['data'=>$out->return_policy_en,'name'=>'return_policy_en','text'=>'سياسة الارجاع باللغة بالانجليزية '])
                       @endcomponent
                   </div>
                   <div class="w-100"></div>
               </div>


           </div>
           <div class="col-md-2">
                   @component('components.upload_image',['data'=>$out->logo,'name'=>'logo','text'=>'شعار المتجر','hint'=>'60 * 60 بيكسل'])
                   @endcomponent
           </div>
           
            <div class="col-md-6">
                      
 @component('components.input',['data'=>$out->ordering,'name'=>'ordering','text'=> 'الترتيب','placeholder'=>'الترتيب','icon'=>'fa fa-sort icon-lg'])
                       @endcomponent
                   </div>
           <div class="clearfix"></div>
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



    </script>



@endsection





