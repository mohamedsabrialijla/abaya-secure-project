<?php $rand=rand(100,9999);?>
<div class="input-daterange input-group input-daterange-{{$rand}} mr-2">
    <input type="text" name="date_from" id="date_from" value="{{--{{HELPER::set_if($_GET['date_from'])}}--}}{{request()->date_from}}" class="form-control" placeholder="من تاريخ">
{{--    <button type="button" class="reset_field" style="display: none"><i class="fa fa-times"></i></button>--}}
    <input type="text" name="date_to" id="date_to" value="{{--{{HELPER::set_if($_GET['date_to'])}}--}}{{request()->date_to}}" class="form-control" placeholder="الى تاريخ">

</div>

@section('scripts')
    @parent
    <script>
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
        $('.input-daterange-{{$rand}}').datepicker({
            rtl: true,
            todayHighlight: true,
            templates: arrows
        });


        $(function() {
            $('.input-daterange-{{$rand}}').keypress(function(event) {
                event.preventDefault();
                return false;
            });
        });
    </script>
@endsection

