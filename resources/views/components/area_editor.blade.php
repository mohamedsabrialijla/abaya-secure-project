<div class="form-group m-form__group @has_error($name)" style="margin-top: 1rem;{{strpos($name, '_en') !== false?'direction:ltr;text-align: left;':''}} " {{strpos($name, '_en') !== false?'dir="ltr"':''}}>
    <label for="{{$name}}">{{$text}} </label>
    <textarea {{isset($not_req)?'':'required'}} name="{{$name}}" id="{{$name}}" class="editor" rows="{{isset($rows)?$rows:5}}" placeholder="{{isset($placeholder)?$placeholder:$text}}">@old($name,isset($data)?$data:null)</textarea>

    @show_error($name)

</div>
@section('area_scripts')
    @parent
<script>
    ClassicEditor
        .create( document.querySelector( '#{{$name}}' ), {

            toolbar: {
                items: [
                    'heading',
                    '|',
                    'fontSize',
                    'fontColor',
                    'alignment',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    'undo',
                    'redo',
                    'exportPdf',
                    'exportWord'
                ]
            },
            language: "{{strpos($name, '_en') === false?'ar':'en'}}",
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;








        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: xcs2esji16m9-tqzhsy8f19xk' );
            console.error( error );
        } );


</script>
@endsection
