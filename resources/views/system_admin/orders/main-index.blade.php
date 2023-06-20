@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page' => route('system_admin.dashboard'), 'title' => 'الصفحة الرئيسية'],
        ['page' => route('system.orders.mainIndex'), 'title' => 'الطلبات'],
    ]" />
@endsection
@section('page_content')
    @component('components.ShowCard',
        [
            'Disname' => 'الطلبات',
            'Disinfo' => 'ادارة الطلبات الخاصة بالتطبيق',
            'actions' => [],
        ])
        <div class="row" style="margin-bottom: 1.22rem;margin-top: -.88rem;">
            <div class="col">
                <form class="form-inline" id="form" style="float: right">
                    <div class="form-group m-form__group">
                        <div class="input-group">
                            <input type="hidden" name="status" value="{{ @Str::lower($status) }}">

                            @component('components.serach.inputwithsearch', ['inputs' => ['name' => 'رقم الفاتورة']])
                            @endcomponent


                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($orderCases as $case)
                @component('components.dash.card',
                    [
                        'col' => '4',
                        'icon' => 'media/svg/icons/Layout/Layout-top-panel-1.svg',
                        'url' => route('system.orders.index', ['status' => Str::lower($case->name_en)]),
                        'name' => ' الطلبات  ' . $case->name,
                        'count' => $case->orders()->count() . ' طلب',
                    ])
                @endcomponent
            @endforeach


        </div>
    @endcomponent
@endsection
@section('custom_scripts')
    <script>
        $(function() {

        })
    </script>
@endsection
