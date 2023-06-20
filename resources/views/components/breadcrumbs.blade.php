@props([
    'breadcrumbs'=>['page'=>'#','title'=>'home']
    ])


<div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>

{{-- Breadcrumb --}}
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
    <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
    @foreach ($breadcrumbs as $k => $item)
        <li class="breadcrumb-item">
            <a href="{{ $item['page'] }}" class="text-muted">
                {{ $item['title'] }}
            </a>
        </li>
    @endforeach
</ul>
