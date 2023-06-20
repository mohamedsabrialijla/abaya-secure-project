{{-- Content --}}
@if (config('layout.content.extended'))
    @yield('page_content')
@else
    <div class="d-flex flex-column-fluid">
        <div class="{{ Metronic::printClasses('content-container', false) }}">
            @yield('page_content')
        </div>
    </div>
@endif
