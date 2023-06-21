@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.trace_payment.index'), 'title' => 'تتبع الدفع'],
    ]" />
@endsection
@section('page_content')
        <div class="row">

            <div class="col-lg-12">

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

                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">الجوال </th>
                                    <th class="text-center">طريقة الدفع </th>
                                    <th class="text-center">تاريخ الاضافة</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($traces as $u)
                                    <tr id="TR_{{ $u->id }}">

                                        <td class="LOOPIDS">{{ $loop->iteration }}</td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="m-checkbox m-checkbox--solid m-checkbox--success m-size-table">
                                                <input type="checkbox" value="<?= $u->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_{{ $u->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            {{ $u->name }}

                                        </td>
                                        
                                         <td class="text-right">
                                            {{ $u->mobile }}

                                        </td>
                                        
                                        <td class="text-right">
                                            {{ $u->mobile }}

                                        </td>

                                 
                                        <td class="text-center"> {{ @$u->created_at->toDateString() }}</td>
                                        <td class="text-center">

                                            <ul class="list-inline">

                                                <a href="{{ route('system.sliders.view', ['slider' => $u->id]) }}"
                                                    class="{{ config('layout.classes.warning') }}  mt-2">
                                                    <i class="fa fa-eye"></i>
                                                    تفاصيل
                                                </a>

                                              

                                                        <li>
                                                            <button type="button" data-id="<?= $u->id ?>"
                                                                data-url="{{ route('system.sliders.delete') }}"
                                                                data-token="{{ csrf_token() }}" data-toggle="tooltip"
                                                                data-theme="dark" title="حذف"
                                                                class="{{ config('layout.classes.delete') }} mt-2 btn-del">
                                                                <i class="{{ config('layout.icons.delete_icon') }}"></i>
                                                                حذف
                                                            </button>
                                                        </li>


                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

               

            </div>
        </div>
    @endcomponent
 

@endsection

@section('custom_scripts')
   
@endsection
