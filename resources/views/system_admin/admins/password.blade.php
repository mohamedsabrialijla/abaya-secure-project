@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]"/>
@endsection
@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'الادارة',
'Disinfo'=>'تعديل كلمة المرور',
'add_url'=>route('system.admin.do.password',$out->id),
'back_url'=>'system.admin.index',
'action'=>'edit',


])

        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        @component('components.input',['name'=>'password','text'=>'كلمة المرور الجديدة','placeholder'=>'كلمة المرور الجديدة','icon'=>'fa-lock'])
                        @endcomponent


                    </div>
                    <div class="col-md-6">
                        @component('components.input',['name'=>'password_confirmation','text'=>'تأكيد كلمة المرور الجديدة','placeholder'=>'تأكيد كلمة المرور الجديدة','icon'=>'fa-lock'])
                        @endcomponent

                    </div>


                    <div class="w-100"></div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>




    @endcomponent

@endsection
