
@php
    $optional=\App\Models\ImageType::where('is_required',0)->where('show_update',1)->get();
    $all=\App\Models\ImageType::get();
@endphp
<div class="row">

    <div class="col-md-{{count($optional)?'10':'12'}}">
        <div class="row multimg_container">
            <div class="text">
                <h5> اختر الصور </h5>
                <small>الرجاء الالتزام بالمقاييس الموضحة</small>
            </div>
            <div class="col-md-{{count($optional)?'10':'12'}}">
                <label for="MYimage_Multi" class="MutiImageText" style="width: 100%;">
                    <span>اختر صور لرفعها</span>
                    <i class="fa fa-image fa-2x MutiImageTextIcon"></i>
                </label>
                <input type="file" id="MYimage_Multi" style="display: none" multiple name="file"
                       data-url="{{route($add_route)}}"
                       data-place="<?=$out->id?>" class="upload_image_multi2">

                <div class="MultiImagePrev">
                    @include($path)

                </div>

            </div>

        </div>
    </div>
    @if(count($optional))
    <div class="col-md-2 pt-4">
        @foreach($optional as $type)

            @if($type->show_update)
                @component('components.switch',['id'=>$type->name.'_check','name'=>$type->field_name,
'data'=>$out->{$type->field_name}
,'text'=>$type->check_text])
                @endcomponent
            @endif

        @endforeach
    </div>
    @endif
    <div class="col-md-12 row justify-content-around align-items-end">

        <?php $iimagges=[]; ?>
        @foreach($all as $type)


            <?php
            if(old($type->name.'_image')){
                $srcImage=old($type->name.'_image');
                $iimagges[$type->id]=$srcImage;

            }else{
                if($type_image=$out->all_images()->where('type',$type->id)->first()){
                    $srcImage=$type_image->image;
                    $iimagges[$type->id]=$srcImage;


                }else{
                    $srcImage='new_add.png';

                }
            }
            ?>

            <div id="{{$type->name}}_image"  style="display:{{$type->is_required == 0?(old($type->name.'_check')?'block':'none'):'block'}};">
                <label class="label" style="width: 100%;height: 100%;">
                    <img class="roundedIMG {{$type->name}}_image" id="{{$type->name}}"
                         style="width: {{$type->width}}px;height: {{$type->height}}px"
                         src="{{asset('uploads/'.$srcImage)}}" alt="avatar">
                    <input type="file" class="sr-only" id="{{$type->name}}_file" name="image" accept="image/*">
                </label>
                <h5 class="text-center">{{$type->text}} {{$type->is_required == 1?'  *':''}}</h5>
                <small class="d-block text-center">العرض :  {{$type->width}} px</small>
                <small class="d-block text-center">الارتفاع :  {{$type->height}} px</small>
            </div>
            <input type="hidden" name="{{$type->name}}_image" id="{{$type->name}}_image_input" value="{{$srcImage}}">
        @endforeach

    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 10px !important;max-height: 85vh;overflow-y: auto;">
                <div class="img-container">
                    <img id="Modal_image" src="">
                </div>
            </div>
            <div class="modal-footer"  style="padding: 3px !important;">
                <button type="button" class="btn btn-block btn-success" id="crop">قص</button>
            </div>
        </div>
    </div>
</div>



<div id="ImageTemplate" style="display:none;">
    <div class="edit_images">
        <img src="##URL" class="Muti-Image-prev" alt="">
        <div class="actions">
            <a href="#" class="DelImageNewCreate" data-image="##DDD" title="حذف"
               style="color: red;cursor: pointer;font-size: 1.2em;text-decoration: none;">
                <i class="fa fa-trash "></i>
            </a>
        </div>
    </div>


</div>
<div id="ImageTemplatePrev" style="display:none;">
    <div class="edit_images">
        <img src="##URL" class="Muti-Image-prev" alt="">
        <div class="actions">
            <a href="#" class="ChooseImage" data-image="##DDD" title="اختيار"
               style="color: #59bf45;cursor: pointer;font-size: 1.2em;text-decoration: none;">
                <i class="fa fa-check "></i>
            </a>
        </div>
    </div>


</div>

<div id="PrevModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div id="newimagePrev"></div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" style="display: none" class="btn btn-default" id="CloSEForm"
                        data-dismiss="modal">
                    اغلاق
                </button>
            </div>
        </div>

    </div>
</div>



@section('upload2_scripts')

    <style>
        .label {
            cursor: pointer;
        }

        .img-container img {
            width: 100%;
            height: auto;
        }
        .roundedIMG{
            border: 1px solid #ddd;
            border-radius: 10px;
        }

    </style>

    <script>
        let files = {!! old('det_images')?collect(json_decode(old('det_images')))->map(function ($elm,$key){return url('uploads/'.$elm);})->toJson(JSON_UNESCAPED_SLASHES):'[]' !!};
        let ToSavefiles = {!! old('det_images')?collect(json_decode(old('det_images')))->map(function ($elm,$key){return ['index'=>$key,'file'=>$elm];})->toJson(JSON_UNESCAPED_SLASHES):'[]' !!};
        let Tindex=0;
        @foreach($all as $type)

        let image_{{$type->name}}= '{{isset($iimagges[$type->id])?$iimagges[$type->id]:''}}';
        let image_{{$type->name}}_req= {{$type->is_required}};

        @endforeach
        function readURL(file, index,where) {
            if(typeof file == 'string'){
                let text = $('#ImageTemplate').html();
                text = text.replace(/##URL/g, file);
                text = text.replace(/##DDD/g, index);
                $(where).append(text)
            }else{
                var done = function (url) {
                    let text = $('#ImageTemplate').html();
                    text = text.replace(/##URL/g, url);
                    text = text.replace(/##DDD/g, index);
                    $(where).append(text)
                };

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }


        }
        function readURLPrev(file, index,where) {

            if(typeof file == 'string'){
                let text = $('#ImageTemplatePrev').html();
                text = text.replace(/##URL/g, file);
                text = text.replace(/##DDD/g, index);
                $(where).append(text)
            }else{
                var done = function (url) {
                    let text = $('#ImageTemplatePrev').html();
                    text = text.replace(/##URL/g, url);
                    text = text.replace(/##DDD/g, index);
                    $(where).append(text)
                };

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }



        }
        function updateImages(){
            $('#AddArea').html('')
            files.forEach(function(item,index){
                readURL(item,index,'#AddArea');
            });
        }


        $(function () {

            @foreach($all as $type)

                @if($type->is_required == 0)
            if($('#{{$type->name.'_check'}}').is(':checked')){

                $('#{{$type->name}}_image').show();

            }else{
                $('#{{$type->name}}_image').hide();
            }
            @endif


            @endforeach

            $('#form').submit( function(eventObj) {

                let n=[];

                ToSavefiles.forEach($elm=>{
                    n.push($elm.file)
                })

                $('#det_images').val(JSON.stringify(n))

                @foreach($all as $type)
                $('#{{$type->name.'_image_input'}}').val(image_{{$type->name}});

                if(image_{{$type->name}}_req == 1 && image_{{$type->name}}==''){
                    Swal.fire({

                        title: 'الرجاء ادخال الصور',

                        text: 'الرجاء ادخال جميع الصور المطلوبة',

                        icon: 'error',

                        timer: 2000,

                        showConfirmButton: false

                    })
                    eventObj.preventDefault();
                    return false
                }
                if(image_{{$type->name}}_req == 0 && image_{{$type->name}}==''){
                    let check_{{$type->name}}=$('#{{$type->name.'_check'}}').is(':checked');
                    if(check_{{$type->name}}){
                        Swal.fire({

                            title: 'الرجاء ادخال الصور',

                            text: 'الرجاء ادخال صورة {{$type->text}}',

                            icon: 'error',

                            timer: 2000,

                            showConfirmButton: false

                        })
                        eventObj.preventDefault();
                        return false
                    }

                }


                @endforeach


                    return true;
            });


            jQuery(document).on('change', '.choose_image_multi', function () {
                var my_files = this.files;
                var fd = new FormData();
                var my_button = jQuery(this);

                for (var i = 0; i < my_files.length; i++) {
                    let type=false;
                    let size=false;
                    var temp = my_files[i];
                    var file_name = temp.name;
                    var temp_size = parseInt(temp.size) / 1024;
                    var extension = file_name.substr((file_name.lastIndexOf('.') + 1)).toLowerCase();
                    if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif')
                        type = true;
                    if (temp_size <= 8192)
                        size = true;

                    if(type && size){

                        fd.append("uploaded_files[]", my_files[i]);
                        fd.append("indexing[]", Tindex);
                        files[Tindex]=my_files[i];
                        Tindex++;
                    }


                }
                fd.append("_token", jQuery('input[name=_token]').val());

                jQuery.ajax({
                    url: UrlForScripts + '/uploadFilesNew',
                    type: 'POST',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (e) {

                            if (e.lengthComputable) {
                            }

                        }, false);
                        return xhr;
                    },
                    beforeSend: function (XMLHttpRequest) {
                        $('body').removeClass("loading");
                        my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-image').addClass('fa-spinner fa-spin');
                        my_button.parents('.multimg_container').find('.upload-image-error-msg-validation').remove();
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            ToSavefiles.push(...data.files);

                            my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-image');
                        } else {
                            alert('هناك خطأ ما !');
                            my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-times');
                        }

                    },

                    error: function (data) {
                        alert('هناك خطأ ما !');
                        my_button.parents('.multimg_container').find('.MutiImageTextIcon').removeClass('fa-spinner fa-spin').addClass('fa-times');
                    }

                });

                updateImages();
            });

            $(document).on('click','.DelImageNewCreate',function () {
                let index=$(this).data('image');
                files.splice(index,1);
                let si=ToSavefiles.findIndex(function(element) {
                    return element.index == index;
                });
                ToSavefiles.splice(si,1);
                updateImages();
            });


            @foreach($all as $type)

            let {{$type->name}} = document.getElementById('{{$type->name}}');

            @endforeach
            var Modal_image = document.getElementById('Modal_image');
            var $modal = $('#modal');
            var cropper;
            let mode = 'logo';
            let selected_index=-1;
            @foreach($all as $type)

            document.getElementById('{{$type->name}}_file').addEventListener('change', function (e) {
                mode = '{{$type->name}}';
                var files = e.target.files;
                var done = function (url) {
                    document.getElementById('{{$type->name}}').value = '';
                    Modal_image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            @endforeach


            $(document).on('click','.ChooseImage',function () {
                let index=$(this).data('image');
                selected_index=index;
                $('#PrevModal').modal('hide');
                var done = function (url) {
                    Modal_image.src = url;
                    $modal.modal('show');
                };

                if (URL) {
                    done(URL.createObjectURL(files[index]));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[index]);
                }

            });


            $modal.on('shown.bs.modal', function () {
                @foreach($all as $type)

                if (mode == '{{$type->name}}') {
                    cropper = new Cropper(Modal_image, {
                        aspectRatio: {{$type->width}}/{{$type->height}},
                        viewMode: 3,
                    });
                }

                @endforeach

            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop').addEventListener('click', function () {
                var canvas;

                $modal.modal('hide');
                files.splice(selected_index,1);
                let si=ToSavefiles.findIndex(function(element) {
                    return element.index == selected_index;
                });
                ToSavefiles.splice(si,1);
                selected_index=-1;
                updateImages();

                if (cropper) {

                    @foreach($all as $type)

                    if (mode == '{{$type->name}}') {
                        canvas = cropper.getCroppedCanvas();
                        {{$type->name}}.src = canvas.toDataURL();
                    }

                    @endforeach
                    canvas.toBlob(function (blob) {
                        var formData = new FormData();

                        formData.append('uploaded_file', blob, 'image.jpg');
                        formData.append("_token", '{{csrf_token()}}');

                        $.ajax(UrlForAssets + '/uploadFile', {
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,

                            xhr: function () {
                                var xhr = new XMLHttpRequest();

                                xhr.upload.onprogress = function (e) {
                                    var percent = '0';
                                    var percentage = '0%';

                                    if (e.lengthComputable) {
                                        percent = Math.round((e.loaded / e.total) * 100);
                                        percentage = percent + '%';
                                        // $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                                    }
                                };

                                return xhr;
                            },

                            success: function (data) {
                                @foreach($all as $type)

                                if (mode == '{{$type->name}}') {
                                    {{$type->name}}.src = data.filelink;
                                    image_{{$type->name}}=data.file_name;
                                }

                                @endforeach

                            },

                            error: function () {

                            },

                            complete: function () {
                                // $progress.hide();
                            },
                        });
                    });
                }
            });

            @foreach($optional as $type)

            $('#{{$type->name.'_check'}}').on('change',function () {
                if($(this).is(":checked")){
                    $('#{{$type->name}}_image').show();
                }else{
                    $('#{{$type->name}}_image').hide();
                }
            })
            @endforeach



        })

    </script>
@endsection
