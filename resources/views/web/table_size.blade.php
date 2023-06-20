@extends('web.master')
@section('css')

@endsection
@section('title')

@endsection
@section('content')
<div style="padding:42px;">
    <p>@lang('site.table_size') </p>

    <p>@lang('site.describe_tabel_sizes')</p>  
  
</div>

<!-- <img src="{{url('/table_size/1.jpg')}}"> -->
<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="{{asset('table_size/1.jpg')}}" >
        </div>
    </figure>
</div>

<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="{{asset('table_size/2.jpg')}}" >
        </div>
    </figure>
</div>



<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="{{asset('table_size/3.jpg')}}" >
        </div>
    </figure>
</div>

<div class="wpb_single_image wpb_content_element vc_align_center">
    <figure class="wpb_wrapper vc_figure">
        <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="1714" height="987" src="{{asset('table_size/5.jpg')}}" >
        </div>
    </figure>
</div> 
@endsection

@section('js')

@endsection
