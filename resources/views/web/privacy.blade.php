@extends('web.master')
@section('css')

@endsection
@section('title')
@lang('site.privacy')
@endsection

@section('content')
<section class="terms_page">
    <div class="container">
        <h4 class="heading main-color bold text-center mb-50">@lang('site.privacy')</h4>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content_section">
                   {!! $content !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================== End terms =============================-->

@endsection

@section('js')

@endsection
