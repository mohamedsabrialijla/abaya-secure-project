<div class="imageCont @has_error($name)" style="text-align: center">
    <h5 style="text-align: center"> {{$text}} </h5>
    <small style="color: gray;text-align: center;display: block;">{{isset($hint)?$hint:'400 * 400 بيكسل'}}</small>
    @show_error($name)
    <div class="imageContainer">
        <label for="MYimage_{{$name}}" style="width: 100%;cursor: pointer;">

            <img src="{{(isset($data) && $data)? url('uploads/' .$data) : url('blank.png') }}"
                 style="{{isset($imgStyle)??"width: 100%"}};" class="MyImagePrivew thumbnail"
                 alt="">


        </label>
        <input type="file" id="MYimage_{{$name}}" style="display: none"
               name="file"
               class="upload_image">
        <input type="hidden" value="<?= isset($data)?$data:null ?>"
               name="{{$name}}"   id="{{$name}}" class="uploaded_image_name">
        <div class="image-loader"></div>
    </div>
</div>

