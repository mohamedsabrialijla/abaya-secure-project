@extends('layouts.admin')
@section('head')

@endsection
@section('page_content')


    @component('components.ShowCard',[
    'Disname'=>'الصفحات',
    'Disinfo'=>'ادارة الصفحات الثابتة في التطبيق',
    'module'=>'pages',
    'actions'=>[

    ]
    ])

        <h4>الرجاء اختيار الصفحة</h4>
        <div class="row justify-content-center">
            <?php foreach($pages as $p){ ?>
                @component('components.dash.card',[
                   'url'=>route('system.pages.update',$p->id),
                   'name'=>$p->title,
                   'count'=>'صفحة'

               ])@endcomponent

            <?php } ?>

        </div>
    @endcomponent

@endsection
