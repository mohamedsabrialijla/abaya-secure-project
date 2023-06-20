@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system_admin.generalProperties'),'title'=>'الخصائص العامة'],
        ]"/>
@endsection
@section('page_content')
    @component('components.ShowCard',[
 'Disname'=>'الخصائص العامة',
 'Disinfo'=>'ادارة الخصائص العامة للموقع',
 'actions'=>[]
 ])
        <div class="row">
            @if(auth('system_admin')->user()->can('view_categories','system_admin'))

                @component('components.dash.card',[
                    'url'=>route('system.categories.index'),
                    'icon'=>'fa fa-list',
                    'name'=>'التصنيفات',
                    'count'=>$categories.' تصنيف',
                    'col'=>3

                ])@endcomponent
                
                @component('components.dash.card',[
                    'url'=>route('system.categories_special.index'),
                    'icon'=>'fa fa-list',
                    'name'=>' التصنيفات الخاصة',
                    'count'=>$categories_s.' تصنيف',
                    'col'=>3

                ])@endcomponent

            @endif

            @if(auth('system_admin')->user()->can('view_colors','system_admin'))
                @component('components.dash.card',[
                  'url'=>route('system.colors.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الألوان ',
                  'count'=>$colors.' لون',
                  'col'=>3

                ])@endcomponent
            @endif
            
            
            
          
            
            
              @if(auth('system_admin')->user()->can('view_style','system_admin'))
                @component('components.dash.card',[
                  'url'=>route('system.styles.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الموديلات ',
                  'count'=>$styles.' موديل',
                  'col'=>3

                ])@endcomponent
            @endif
            
            
              @if(auth('system_admin')->user()->can('view_clothes','system_admin'))
                @component('components.dash.card',[
                  'url'=>route('system.clothes.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'الأقمشة',
                  'count'=>$clothes.' قماش',
                  'col'=>3

                ])@endcomponent
            @endif
            
            

                @if(auth('system_admin')->user()->can('view_sizes','system_admin'))
                @component('components.dash.card',[
                  'url'=>route('system.sizes.index'),
                  'icon'=>'fa fa-list',
                  'name'=>'المقاسات ',
                  'count'=>$sizes.' مقاس',
                  'col'=>3

                 ])@endcomponent
            @endif
               @if(auth('system_admin')->user()->can('view_colors','system_admin'))
                    @component('components.dash.card',[
                      'url'=>route('system.govs.index'),
                      'icon'=>'fa fa-list',
                      'name'=>'المحافضات والمناطق ',
                      'count'=>$areas.'منطقة',
                      'col'=>3
                     ])@endcomponent
                @endif
                
                
                
          
            
            
            
            
           
        </div>


    @endcomponent


@endsection
@section('custom_scripts')
    <script>
        $(function () {

        })
    </script>

@endsection
