<!doctype html>
<html lang="en">
<head>
    @include('filter.head')
    @yield('style')
</head>
<body>
<div class="container main">
    <div class="jumbotron">
        <h1 class="display-3"><img src="{{ asset('filter/images/logo.png') }}"  width="100px"/>Abaya</h1>
        <p class="lead">Abaya</p>
    </div>

    @yield('content')

</div>

@include('filter.script')
@stack('script')
<script>
    $(document).on('click','.pagination a',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var page = url.split('page=')[1];
        window.history.pushState("", "", url);
        faceted(page);
    })
</script>
@yield('script')
</body>
</html>
