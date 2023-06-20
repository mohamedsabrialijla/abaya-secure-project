<div class="input-group mr-2">
    @foreach($inputs as $key=>$text)
        <input type="text" name="{{$key}}" id="{{$key}}" class="form-control m-input m-input--pill " style="border-radius: 0"
               value="{{--{{HELPER::set_if($_GET[$key])}}--}}{{request()->$key}}" placeholder="{{$text}}">

    @endforeach
</div>

@section('scripts')
   {{-- <script>
        $("input[name=price_from]").keyup(function () {
            if ($(this)) {
                $(this).attr({
                    'pattern': '\\d*',
                    'title': "الرجاء ادخال ارقام فقط"
                });
            }
        });

        $("input[name=price_to]").keyup(function () {
            if ($(this)) {
                $(this).attr({
                    'pattern': '\\d*',
                    'title': "الرجاء ادخال ارقام فقط"
                });
            }
        });
    </script>--}}

@endsection
