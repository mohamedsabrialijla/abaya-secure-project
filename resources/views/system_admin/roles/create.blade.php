@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.roles.index'),'title'=>'الصلاحيات']
        ]"/>
@endsection

@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'الصلاحيات',
'Disinfo'=>'اضافة صلاحية جديدة',
'add_url'=> route('system.roles.do.create'),
'back_url'=>'system.roles.index',
'action'=>'add',


])
        <div class="row justify-content-center">

            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['name'=>'name','text'=>'اسم الصلاحية','placeholder'=>'اسم الصلاحية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-12">
                <div class="row">

                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th style="text-align: center">اسم القسم</th>
                            @php
                                $permission_maps = ['view', 'add', 'edit', 'delete','activate','feature','slider'];
                            @endphp

                            @foreach($permission_maps as $p)
                                <th style="text-align: center">{{__('cp.'.$p)}}</th>
                            @endforeach
                            <th style="text-align: center">فعل</th>
                            <th style="text-align: center">عطل</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $models = ['dashboard','admins', 'settings', 'roles','translations','categories',
                                        'colors','sizes','stores','products','orders','orderCases','coupons',
                                        'users', 'notifications','contacts','about_us','terms','policies','payments'];
                        @endphp


                        @foreach($models as $model)
                            <tr>
                                <td style="text-align: center">
                                    {{__('cp.'.$model)}}{{-- اسم المودل --}}
                                </td>
                                @foreach($permission_maps as $permission_map)
                                    <td style="text-align: center">
                                        <label class="checkbox justify-content-center">
                                            <input type="checkbox"
                                                   name="permission[]" class="rule"
                                                   value="{{$permission_map . '_' . $model}}"><span></span>
{{--                                            {{$permission_map . '_' . $model}}--}}
                                        </label>
                                    </td>
                                @endforeach
                                <td style="width: 5%;">
                                    <a href="#" class="reg-all" style="padding: 5px;margin: 0 5px;"
                                       data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                       title="فعل الجميع"><i
                                            class="fa fa-check"></i> </a>
                                </td>
                                <td style="width: 5%;">
                                    <a href="#" class="de-reg-all" style="padding: 5px;margin: 0 5px;"
                                       data-skin="dark" data-tooltip="m-tooltip" data-placement="top"
                                       title="عطل الجميع"><i
                                            class="fa fa-times"></i> </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    @endcomponent




    <!-- END PAGE BASE CONTENT -->

@endsection


@section('custom_scripts')



    <script>

        $(function () {

            /*       $('#form').validate({

                       errorElement: 'div', //default input error message container

                       errorClass: 'abs_error help-block has-error',


                   }).init();*/

        })


    </script>

    <script>
        $(function () {
            $('.reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function (i) {
                    var IsCheck = $(this).is(":checked");
                    if (!IsCheck) {
                        $(this).click();
                    }
                });
            });
            $('.de-reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function (i) {
                    var IsCheck = $(this).is(":checked");
                    if (IsCheck) {
                        $(this).click();
                    }
                });
            });

        })
    </script>


@endsection
