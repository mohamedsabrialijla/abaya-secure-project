@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخائص العامة'],
        ['page'=>route('system.govs.index'),'title'=>'المناطق']
        ]"/>
@endsection
@section('page_content')


    @component('components.AddEditCard',[
'Disname'=>'المناطق',
'Disinfo'=>'تعديل بيانات المنطقة',
'add_url'=>route('system.areas.do.update',$out->id),
'back_url'=>'system.govs.index',
'action'=>'edit',


])

        <div class="row justify-content-center">
            <div class="w-100"></div>
            <div class="w-100"></div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'المنطقة باللغة العربية','placeholder'=>'ادخل المنطقة باللغة العربية','icon'=>'fa-user-alt'])
                @endcomponent

            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.input',['name'=>'name_en','data'=>$out->name_en,'text'=>'المنطقة باللغة الانجليزية','placeholder'=>'ادخل المنطقة باللغة الانجليزية','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.selectWithAdd',['data'=>$out->gov_id,'name'=>'gov_id','text'=>'المحافظة','select'=>$govs,'add_url'=>route('system.categories.createJson')])
                @endcomponent
            </div>
            <div class="w-100"></div>

            <div class="col-md-2 align-right">
                    <label class="col col-form-label" for="is_cash">الدفع (كاش)</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="is_cash" name="is_cash"
                                       @if(old('is_cash',$out->is_cash)) checked @endif/>
                                <span></span>
                            </label>
                        </span>
                    </div>

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



    </script>



@endsection





