@extends('layouts.admin')

@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'الصفحات',
'Disinfo'=>'تعديل بيانات الصفحة',
'add_url'=>route('system.pages.do.update',$page->id),
'back_url'=>'system.pages.index',
'action'=>'edit',


])

        <div class="row">
            <div class="col-md-6">
                @component('components.input',['data'=>$page->title_ar,'name'=>'title_ar','text'=>'الاسم','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('components.input',['data'=>$page->title_en,'name'=>'title_en','text'=>'name','placeholder'=>'Enter the name','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                @component('components.area_editor',['data'=>$page->text_ar,'name'=>'text_ar_html','text'=>'التفاصيل '])
                @endcomponent

            </div>
            <div class="col-md-12">

                @component('components.area_editor',['data'=>$page->text_en,'name'=>'text_en_html','text'=>'details '])
                @endcomponent

            </div>

        </div>
    @endcomponent
@endsection




@section('custom_scripts')

    <script>
        $(document).ready(function () {
            var form3 = $('#form');
            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error'
            }).init();


        });
    </script>
@endsection
