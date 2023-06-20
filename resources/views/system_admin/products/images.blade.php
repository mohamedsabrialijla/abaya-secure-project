@php
$images=[];
@endphp
@foreach ($out->images as $a)
@php $images[]=$a->image;@endphp
<div class="edit_images">
    <img src="{{url('public/uploads/'.$a->image)}}" class="Muti-Image-prev" alt="">
    <div class="actions">

        @if($a->is_main ==1)
        <i class="fa fa-star"
           style="color: green;cursor: pointer;font-size: 1.2em" title="الصورة الرئيسية"></i>
        @else
        <a href="#" class="SetAsDefault" data-url="{{route('system.products.default_image')}}" data-image="{{$a->id}}" title="تعيين كصورة رئيسية" style="color: yellow;cursor: pointer;font-size: 1.2em;text-decoration: none;">
            <i class="fa fa-star "></i>
        </a>
        <a href="#" class="DelImage" data-url="{{route('system.products.delete_image')}}" data-image="{{$a->id}}" title="حذف" style="color: red;cursor: pointer;font-size: 1.2em;text-decoration: none;">
            <i class="fa fa-trash "></i>
        </a>
        @endif


    </div>
</div>
@endforeach
<input type="hidden" value='@json($images)'  class="uploaded_multi_image_name" name="uploaded_multi_image_name">
