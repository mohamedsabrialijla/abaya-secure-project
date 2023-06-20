@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.payments.index'), 'title' => 'طرق الدفع'],
    ]" />
@endsection
@section('page_content')

    @component('components.ShowCard', [
        'Disname' => 'طرق الدفع',
        'Disinfo' => 'ادارة طرق الدفع',
        'add_url' => null,
        'module' => 'payments',
        'actions' => [
        [
        'route' => 'system.payments.activate',
        'icon' => config('layout.icons.activate_icon'),
        'text' => 'تفعيل',
        'role' => 'activate',
        ],
        [
        'route' => 'system.payments.deactivate',
        'icon' => config('layout.icons.deactivate_icon'),
        'text' => 'تعطيل',
        'role' => 'activate',
        ],
        ],
        ])
        <div class="row">

            <div class="col-lg-12">


                @if (isset($out) && count($out) > 0)
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
                                    <th class="text-center">أيقونة طريقة الدفع</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">نسبة العمولة %</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">الإعدادات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out as $o)
                                    <tr id="TR_{{ $o->id }}">

                                        <td class="LOOPIDS">
                                            {{ ($out->currentpage() - 1) * $out->perpage() + $loop->iteration }}</td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                                <input type="checkbox" value="<?= $o->id ?>" name="Item[]"
                                                    class="CheckedItem" id="che_{{ $o->id }}">
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <img style="background-color: #ccc;" src="{{ $o->icon_url }}"
                                                class="img_table" alt="">
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->name_ar }}</p>
                                            <p>{{ $o->name_en }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p>{{ $o->ratio }} %</p>
                                        </td>
                                        <td class="text-center">
                                            {{-- @if (auth('system_admin')->user()->can('activate_payments', 'system_admin')) --}}
                                            <span class="switch switch-icon">
                                                <label>
                                                    <input type="checkbox" class="paymentActive" id="is_active"
                                                        data-id="{{ $o->id }}" name="is_active"
                                                        {{ $o->is_active === 1 ? 'checked="checked"' : '' }} />
                                                    <span></span>
                                                </label>

                                                @if ($o->is_active == 1)
                                                    <span class="m--font-success"> مفعل </span>
                                                @else
                                                    <span class="m--font-warning"> معطل </span>
                                                @endif
                                            </span>

                                            {{-- @else --}}
                                            {{-- @if ($payment->is_active == 1) --}}
                                            {{-- <span class="m--font-success"> مفعل </span> --}}
                                            {{-- @else --}}
                                            {{-- <span class="m--font-warning"> معطل </span> --}}
                                            {{-- @endif --}}
                                            {{-- @endif --}}
                                        </td>
                                        {{-- <td class="text-center"> --}}
                                        {{-- @if (auth('system_admin')->user()->can('activate_payments', 'system_admin')) --}}
                                        {{-- <span class="switch switch-icon"> --}}
                                        {{-- <label> --}}
                                        {{-- <input type="checkbox" class="paymentActive" id="is_active" --}}
                                        {{-- data-id="{{$o->id}}" name="is_active" {{$o->is_active === 1 ? 'checked="checked"':''}}/> --}}
                                        {{-- <span></span> --}}
                                        {{-- </label> --}}

                                        {{-- @if ($o->is_active == 1) --}}
                                        {{-- <span class="m--font-success"> مفعل </span> --}}
                                        {{-- @else --}}
                                        {{-- <span class="m--font-warning"> معطل </span> --}}
                                        {{-- @endif --}}
                                        {{-- </span> --}}

                                        {{-- @else --}}
                                        {{-- @if ($o->is_active == 1) --}}
                                        {{-- <span class="m--font-success"> مفعل </span> --}}
                                        {{-- @else --}}
                                        {{-- <span class="m--font-warning"> معطل </span> --}}
                                        {{-- @endif --}}
                                        {{-- @endif --}}
                                        {{-- </td> --}}
                                        <td class="text-center">

                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{ route('system.payments.update', ['id' => $o->id]) }}"
                                                        class=" {{ config('layout.classes.warning') }} mt-2 "
                                                        title="تعديل" data-toggle="tooltip" data-theme="dark"
                                                        data-placement="top">
                                                        <i class="fa fa-edit"></i> تعديل
                                                    </a>

                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {!! $out->links() !!}
                @else
                    <div class="note note-info">
                        <h4 class="block">لا يوجد بيانات مضافة</h4>
                    </div>
                @endif

            </div>
        </div>
    @endcomponent


@endsection
@section('custom_scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            $('.paymentActive').change(function() {
                let is_active = $(this).prop('checked') === true ? 1 : 0;
                let id = $(this).data('id');
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: '{{ route('system.payments.change_is_active') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'is_active': is_active,
                        'id': id
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });


        });
    </script>
@endsection
