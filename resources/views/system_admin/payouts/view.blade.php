@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],

        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'المصممون',
'Disinfo'=>' عرض بيانات المصمم '.$out->name,

'module'=>'stores',
'actions'=>[

   ]
])
        <div class="row justify-content-center">
            <div class="col-md-6 ">

            @include('system_admin.stores.details')
            </div>
        </div>
    @endcomponent
@endsection
