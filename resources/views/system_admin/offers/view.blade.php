@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],

        ]"/>
@endsection
@section('page_content')

    @component('components.ShowCard',[
'Disname'=>'العروض',
'Disinfo'=>' عرض بيانات العرض '.$out->name,

'module'=>'offers',
'actions'=>[

   ]
])
        <div class="row justify-content-center">
            <div class="col-md-6 ">

            @include('system_admin.offers.details')
            </div>
        </div>
    @endcomponent
@endsection
