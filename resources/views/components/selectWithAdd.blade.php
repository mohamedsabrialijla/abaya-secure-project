<div class="form-group m-form__group @has_error('{{$name}}')">
    <label for="{{$name}}">{{$text}} </label>
    <select name="{{$name}}" class="selWithAdd" style="width: 100%;" id="{{$name}}"
            {{isset($not_req)?'':'required'}} data-addurl="{{$add_url}}" data-token="{{csrf_token()}}" >
        @if(!isset($no_def))
            <option value="0">{{isset($placeholder)?$placeholder:$text}}</option>
        @endif
{{--        <option value="AddNewToList" > اضافة عنصر جديد</option>--}}
        @foreach($select as $s)
            <option value="{{$s->id}}" {{old($name,isset($data)?$data:null)==$s->id?'selected':''}}>{{$s->name}}</option>
        @endforeach

    </select>

    <input type="hidden" name="RetSelect" class="RetSelect">
    @show_error($name)

</div>
@section('scripts')
    @parent
    <script>
        $(function (){
            $("body").on('change', ".selWithAdd",

                function () {


                    if($(this).val() === 'AddNewToList'){
                        var select = $(this);

                        $('.RetSelect').val(select.attr('id'));

                        $('#name_ar_to_add').val('');

                        $('#name_en_to_add').val('');

                        $('#AddNewModal').modal('show');
                        select.val(0).trigger('change');


                    }


                });
            $("body").on('click', '.btn_addToList',

                function () {

                    var selecttxt = $('.RetSelect').val();

                    var select = $('#' + selecttxt);

                    var url = select.data('addurl');

                    var token = select.data('token');

                    var name = $('#name_ar_to_add').val();

                    var name_en = $('#name_en_to_add').val();


                    if (name == '') {

                        alert('الرجاء ادخال الاسم');

                        return;

                    }

                    if (name_en == '') {

                        alert('Please enter the name');

                        return;

                    }


                    $.post(url,

                        {

                            _token: token,

                            name_ar: name,

                            name_en: name_en,


                        },

                        function (data, status) {

                            if (data.done == 1) {

                                select.html(data.out).trigger('change');

                                $('#AddNewModal').modal('hide');

                                Swal.fire({

                                    title: 'تمت الاضافة بنجاح',

                                    text: 'تمت الاضافة بنجاح',

                                    icon: 'success',

                                    timer: 2000,

                                    showConfirmButton: false

                                })

                                $('#name_ar_to_add').val('');

                                $('#name_en_to_add').val('');




                            } else {


                                Swal.fire({

                                    title: 'حدث خطأ ما',

                                    text: 'خطأ مجهول',

                                    icon: 'error',

                                    timer: 4000,

                                    showConfirmButton: false

                                })


                            }

                        })


                });
        })
    </script>
@endsection
