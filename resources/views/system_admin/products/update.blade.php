@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
    ['title'=>'الصفحة الرئيسية','page'=>route('system_admin.dashboard')],
    ['title'=>'المنتجات','page'=>route('system.products.index')],
    ]"

@endsection
@section('page_content')

    @component('components.AddEditCard',[
'Disname'=>'المنتجات',
'Disinfo'=>'تعديل بيانات منتج ',
'add_url'=>route('system.products.do.update',$out->id),
'back_url'=>'system.products.index',
'action'=>'edit',


])


        <div class="row">
            
             <div class="col-md-6">
                      
                       @component('components.input',['data'=>$out->ordering,'name'=>'ordering','text'=> 'الترتيب','placeholder'=>'الترتيب','icon'=>'fa fa-sort icon-lg'])
                       @endcomponent
                   </div>
                   
                   <div class="col-md-6"></div>

            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_ar,'name'=>'name_ar','text'=>'الاسم باللغة العربية','placeholder'=>'ادخل الاسم','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->name_en,'name'=>'name_en','text'=>'Name in English','placeholder'=>'Enter the name','icon'=>'fa-user-alt'])
                @endcomponent
            </div>
            <div class="w-100"></div>


            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.selectWithAdd',['data'=>$out->category_id,'name'=>'category_id','text'=>'التصنيف','select'=>$categories,'add_url'=>route('system.categories.createJson')])
                @endcomponent

            </div>
            
             <div class="col-md-6">
                <label>التصنيفات  </label>
               <select class="js-example-basic-multiple col-md-12" name="categories[]" multiple="multiple">
                @foreach($categories as $p)
                  <option @if(isset($product_categories) && $product_categories != '' && in_array($p->id,$product_categories)) selected @endif value="{{$p->id}}">{{$p->name_ar}}</option>
                @endforeach
              </select>
            </div>
            
            
            <div class="col-md-6">
                @component('components.selectWithAdd',['data'=>$out->store_id,'name'=>'store_id','text'=>'المصمم','select'=>$stores,'add_url'=>route('system.stores.createJson')])
                @endcomponent

            </div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->price,'type'=>'number','min'=>0,'name'=>'price','text'=>'السعر','icon'=>'fa-dollar-sign'])
                @endcomponent

            </div>
            <div class="col-md-6">
                @component('components.input',['data'=>$out->discount_ratio,'name'=>'ratio','text'=>'نسبة الخصم تترك 0 اذا لا يوجد خصم','icon'=>'fa-percent'])
                @endcomponent

            </div>

            <div class="w-100"></div>

            <div class="col-md-6">
                @component('components.area_editor',['data'=>$out->details_ar,'name'=>'details_ar','text'=>'التفاصيل'])
                @endcomponent

            </div>
            <div class="col-md-6">
                @component('components.area_editor',['data'=>$out->details_en,'name'=>'details_en','text'=>'Details'])
                @endcomponent

            </div>



            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المقاسات</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.add')}} sizeid"
                                        data-toggle="modal" data-target="#size">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        <div class="m-content">
                            <div class="row sizeValue">
{{--                                @foreach($sizeslist as $size)--}}
{{--                                    <div class="col-3"><input type="checkbox" name="sizes[]" value="{{$size->id}}" {{in_array($size->id,$product_sizes)? 'checked':''}}>--}}
{{--                                        {{$size->name}}--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}

                                    @foreach($sizeslist as $key=>$size)
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <input type="checkbox"
                                                           name="sizes[{{$key}}][id]"
                                                           {{ in_array($size->id,$product_sizes)?'checked':'' }}
                                                           class="volumeData"
                                                           value="{{$size->id}}">
                                                    {{$size->name}}
                                                </div>


                                            </div>
                                        </div>
                                    @endforeach
                                    @show_error('sizes')

                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.add')}} colorid"
                                        data-toggle="modal" data-target="#color">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row colorValue">
                                @foreach($colors_list as $color)
                                    <div class="col-3"> <input type="checkbox" name="colors[]"  value="{{$color->id}}" {{in_array($color->id,$product_colors)? 'checked':''}}>
                                        {{$color->name}}
                                    </div>
                                @endforeach
                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>
            
            
             <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">القماش</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.add')}} clothesid"
                                        data-toggle="modal" data-target="#clothes">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row clothesValue">
                                @foreach($clothes_list as $cloth)
                                    <div class="col-4"> <input type="checkbox" name="clothes[]"  value="{{$cloth->id}}" {{in_array($cloth->id,$product_clothes)? 'checked':''}}>
                                        {{$cloth->name}}
                                    </div>
                                @endforeach
                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>
            
            
            <div class="col-md-6">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الموديلات</h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.add')}} styleid"
                                        data-toggle="modal" data-target="#style">
                                    <i class="la la-plus"></i>
                                    <span>اضافة جديد</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row styleValue">
                                @foreach($style_list as $style)
                                    <div class="col-4"> <input type="checkbox" name="style[]"  value="{{$style->id}}" {{in_array($style->id,$product_style)? 'checked':''}}>
                                        {{$style->name}}
                                    </div>
                                @endforeach
                            </div>
                            <span></span>
                        </div>
                    </div>

                </div>

            </div>
            
            
            

            <div class="col-md-6 mt-5">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المخزون</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="m-content">

                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                @foreach($out->productSizes as $key=>$size)
                                    <li class="nav-item ">
                                        <a class="nav-link {{ (isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':'' }}"
                                           data-toggle="tab" href="#tab{{$key+1}}">
                                            {{$size->size->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach($out->productSizes as $key=>$productSize)
                                    <div class="tab-pane {{ (isset($active_tab) && $active_tab=="tab".$key+1)?'active':$key==0?'active':'' }} " id="tab{{$key+1}}" role="tabpanel">


                                        <div class="row mt-5">


                                            <div class="col-md-12" style="height: 200px; overflow: auto">


                                                <table class="table table-hover">
                                                    <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>المقاس</th>
                                                        <th>العملية</th>
                                                        <th>تاريخ العملية</th>
                                                        <th>الكمية</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($productSize->stock as $key=>$stock)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$stock->productSize->size->name}}</td>
                                                            <td>{{$stock->type_label}}</td>
                                                            <td>{{\Carbon\Carbon::parse($stock->created_at)->format('Y-m-d H:i:s')}}</td>
                                                            <td>{{$stock->qty}}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="table-active">
                                                        <td colspan="4">
                                                            اجمالي الكمية المتوفرة
                                                        </td>
                                                        <td >
                                                            {{$productSize->qty()}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-md-12">
                <x-multiuploadupdate
                    text=" صور المنتج"
                    hint="الرجاء اختيار حجم مناسب"
                    name="images"
                    addroute="system.products.upload_image"
                    path="system_admin.products.images"
                    :out="$out"/>
            </div>


            <div class="w-100"></div>

            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="is_active">الحالة</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="is_active" name="is_active" @if(old('is_active',$out->is_active)) checked @endif/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>
            <div class="w-100"></div>
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="show_in_slider">إضافة للأكثر مبيعا</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="show_in_slider" name="show_in_slider"
                                       @if(old('show_in_slider',$out->show_in_slider)) checked @endif/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>


            <div class="w-100"></div>

        {{-- <div class="col-md-12">
            <div class="row">

                <div class="col-md-2" id="slider_image" style="display:none">
                    @component('components.upload_image',['data'=>$out->slider_image,'name'=>'slider_image','text'=>'الصورة الغلاف','hint'=>'60 * 60 بيكسل'])
                    @endcomponent
                    <br/>

                </div>


            </div>
        </div> --}}
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="is_feature">اضافة المنتج كمميز</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                <input type="checkbox" id="is_feature_switch" name="is_feature"
                                       @if(old('is_feature',$out->is_feature)) checked @endif/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-4">
                <div class="row justify-content-between">
                    <label class="col col-form-label" for="cod"> إتاحة الدفع عند الاستلام</label>
                    <div class="col">
                        <span class="switch switch-icon">
                            <label>
                                {{-- @dd($out->cod) --}}
                                <input type="checkbox" id="" name="cod"
                                       @if(old('cod',$out->cod)) checked @endif/>
                                <span></span>
                            </label>
                        </span>
                    </div>

                </div>

            </div>
            <div class="w-100"></div>
        </br>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5" id="annotation_ar" style="display:none">
                        @component('components.input',['data'=>$out->annotation_ar,'name'=>'annotation_ar' ,'text'=>'نص المنتج المميز بالعربية','not_req'=>true])
                        @endcomponent
                    </div>

                    <div class="col-md-5" id="annotation_en" style="display:none">
                        @component('components.input',['data'=>$out->annotation_en,'name'=>'annotation_en' ,'text'=>'نص المنتج المميز بالنجليزية','not_req'=>true])
                        @endcomponent
                    </div>
                    <div class="col-md-2" id="annotation_image" style="display:none">
                        @component('components.upload_image',['data'=>$out->feature_image,'name'=>'feature_image','text'=>'الصورة المميزة','hint'=>'60 * 60 بيكسل'])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>






    @endcomponent


    <div id="size" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">المقاسات
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة مقاس جديد
                                </div>
                            </h3>

                        </div>

                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.delete')}}" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="{{route('system.sizes.addNewSize')}}"
                                        data-token="{{csrf_token()}}"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="{{config('layout.classes.add')}} addSize">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">

                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    @component('components.input',['name'=>'size_ar','text'=>'المقاس باللغة العربية','placeholder'=>'ادخل المقاس باللغة العربية','id'=>'size_ar'])
                                    @endcomponent
                                    <span class=" text-danger" id="size_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    @component('components.input',['name'=>'size_en','text'=>'المقاس باللغة الانجليزية','placeholder'=>'ادخل المقاس باللغة الانجليزية','id'=>'size_en'])
                                    @endcomponent
                                    <span class="text-danger" id="size_en_error"></span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div id="color" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة لون جديد
                                </div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.delete')}}" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="{{route('system.colors.addNewColor')}}"
                                        data-token="{{csrf_token()}}"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="{{config('layout.classes.add')}} addColor">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    @component('components.colorpicker',['name'=>'hexa','text'=>'اللون'])
                                    @endcomponent
                                </div>

                                <div class="w-100"></div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    @component('components.input',['name'=>'color_ar','text'=>'اسم اللون','placeholder'=>'ادخل اسم اللون'])
                                    @endcomponent
                                    <span class="text-danger" id="color_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    @component('components.input',['name'=>'color_en','text'=>'color name','placeholder'=>'Enter the color name'])
                                    @endcomponent
                                    <span class="text-danger" id="color_en_error"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    
                      

                </div>
            </div>

        </div>
    </div>
    
    
    
    <div id="clothes" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة قماش جديد
                                </div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.delete')}}" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="{{route('system.clothes.addNewClothes')}}"
                                        data-token="{{csrf_token()}}"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="{{config('layout.classes.add')}} addClothes">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">
                               

                                <div class="w-100"></div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    @component('components.input',['name'=>'clothes_ar','text'=>'اسم القماش','placeholder'=>'الق اسم القماش'])
                                    @endcomponent
                                    <span class="text-danger" id="clothes_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    @component('components.input',['name'=>'clothes_en','text'=>'clothes name','placeholder'=>'Enter the clothes name'])
                                    @endcomponent
                                    <span class="text-danger" id="clothes_en_error"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    
                      

                </div>
            </div>

        </div>
    </div>
    
    
    
    <div id="style" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">الألوان
                                <div class="text-muted pt-2 font-size-sm">
                                    اضافة موديل جديد 
                                </div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <div class="card-toolbar">
                                <button type="button" class="{{config('layout.classes.delete')}}" data-dismiss="modal"
                                        aria-label="Close">
                                    <i class="ki ki-close"></i>
                                    <span>الغاء</span>
                                </button>
                                <button type="button"
                                        data-url="{{route('system.styles.addNewStyle')}}"
                                        data-token="{{csrf_token()}}"
                                        data-toggle="tooltip" data-theme="dark"
                                        class="{{config('layout.classes.add')}} addStyle">
                                    <i class="la la-check"></i>
                                    <span>اضافة</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="m-content">
                            <div class="row justify-content-center">
                               

                                <div class="w-100"></div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    @component('components.input',['name'=>'style_ar','text'=>'اسم الموديل','placeholder'=>'الق اسم الموديل'])
                                    @endcomponent
                                    <span class="text-danger" id="style_ar_error"></span>
                                </div>
                                <div class="w-100"></div>

                                <div class="col-md-12">
                                    @component('components.input',['name'=>'style_en','text'=>'style name','placeholder'=>'Enter the style name'])
                                    @endcomponent
                                    <span class="text-danger" id="style_en_error"></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    
                      

                </div>
            </div>

        </div>
    </div>


@endsection

@section('custom_scripts')


    <script>
        $(function () {
            var form = $('#form');
            form.validate({
                errorElement: 'div', //default input error message container
                errorClass: 'abs_error help-block has-error',
                rules: {
                    price: {
                        required: true,
                        number: true
                    }
                }

            }).init();
            if ( $('#show_in_slider').is(':checked')) {

                $('#slider_image').show()
            } else {

                $('#slider_image').hide()

            }

        });

    </script>

    <script>

        @if(old('is_feature',$out->is_feature))
        $('#annotation_ar').show()
        $('#annotation_en').show()
        $('#annotation_image').show()
        @else
        $('#annotation_ar').hide()
        $('#annotation_en').hide()
        $('#annotation_image').hide()
        @endif

        @if(old('cod',$out->cod))
        $('#annotation_ar').show()
        $('#annotation_en').show()
        $('#annotation_image').show()
        @else
        $('#annotation_ar').hide()
        $('#annotation_en').hide()
        $('#annotation_image').hide()
        @endif

        $(function () {

            $('#is_feature_switch').on('change', function () {
                var value = $('#is_feature_switch').is(':checked');
                console.log(value)
                if (value) {
                    $('#annotation_ar').show()
                    $('#annotation_en').show()
                    $('#annotation_image').show()
                } else {
                    $('#annotation_ar').hide()
                    $('#annotation_en').hide()
                }
            });
            $('#is_cod_switch').on('change', function () {
                var value = $('#is_cod_switch').is(':checked');
                console.log(value)
                if (value) {
                    $('#annotation_ar').show()
                    $('#annotation_en').show()
                    $('#annotation_image').show()
                } else {
                    $('#annotation_ar').hide()
                    $('#annotation_en').hide()
                }
            });

            $('#show_in_slider').on('change', function () {
                var value = $('#show_in_slider').is(':checked');
                if (value) {

                    $('#slider_image').show()
                } else {

                    $('#slider_image').hide()

                }
            });

        });
    </script>

    <script>

        $('.sizeid').click(function () {
            $("#size").modal('show');
        });


        $('.addSize').click(function () {

            var url = '{{route('system.sizes.addNewSize')}}';

            let size_ar = $('input[name=size_ar]');
            let size_en = $('input[name=size_en]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    size_ar: size_ar.val(),
                    size_en: size_en.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.sizeValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            // items += '<div class="col-3"><input type="checkbox" name="sizes[]" checked value="' + key + '">' + ' ' + value + ' ' + '</div>';

                            items += '<div class="col-md-6"><div class="form-group row">' +
                                '<div class="col-md-4"><input type="checkbox" name="sizes[' + key + '][id]" class="volumeData" checked value="' + key + '">' + ' ' + value + ' ' + '</div>' +
                                '<div class="col-md-8"><input type="text" class="volume_price" name="sizes[' + key + '][qty]" value="" required placeholder="أدخل  الكمية"></div>' +
                                '</div></div>';

                        });
                        container.append(items);

                        $("#size").modal('hide');
                    } else {

                        alert('هناك خطأ ما');

                    }

                })
                .fail(function (data) {
                    var response = $.parseJSON(data.responseText);

                    $.each(response.errors, function (key, value) {
                        $('#' + value.field).css('border-color', '#F64E60');
                        $('#' + value.field + '_error').text(value.error);

                    });//end each
                })
            ;


        });


    </script>


    <script>

        $('.colorid').click(function () {
            $("#color").modal('show');
        });


        $('.addColor').click(function () {

            var url = '{{route('system.colors.addNewColor')}}';

            let color_ar = $('input[name=color_ar]');
            let color_en = $('input[name=color_en]');
            let hexa = $('input[name=hexa]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    color_ar: color_ar.val(),
                    color_en: color_en.val(),
                    hexa: hexa.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.colorValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            items += '<div class="col-3"><input type="checkbox" name="colors[]" value="' + key + '">' + ' ' + value + ' ' + '</div>';
                        });
                        container.append(items);

                        $("#color").modal('hide');
                    } else {

                        alert('هناك خطأ ما');

                    }

                })

                .fail(function (data) {
                    var response = $.parseJSON(data.responseText);

                    $.each(response.errors, function (key, value) {
                        $('#' + value.field).css('border-color', '#F64E60');
                        $('#' + value.field + '_error').text(value.error);

                    });//end each
                })
            ;


        });
        $(function () {
            $('.volumeData').change(function () {
                let value = $(this).is(':checked');
                if (value) {

                    $(this).parent().parent().find('.volume_price').attr("required", "true").removeAttr('disabled').show();

                } else {
                    // $(this).parent().parent().find('.volume_price').val('');
                    $(this).parent().parent().find('.volume_price').attr("required", "false").attr("disabled", "disabled").hide();
                }
            });

        });
        
        
        
        
        
         $('.clothesid').click(function () {
            $("#clothes").modal('show');
        });
        
        
        
        $('.addClothes').click(function () {

            var url = '{{route('system.clothes.addNewClothes')}}';

            let clothes_ar = $('input[name=clothes_ar]');
            let clothes_en = $('input[name=clothes_en]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    name_ar: clothes_ar.val(),
                    name_en: clothes_en.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.clothesValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            items += '<div class="col-4"><input type="checkbox" name="clothes[]" value="' + key + '">' + ' ' + value + ' ' + '</div>';
                        });
                        container.append(items);

                        $("#clothes").modal('hide');
                    } else {

                        alert('هناك خطأ ما');

                    }

                })

                .fail(function (data) {
                    var response = $.parseJSON(data.responseText);

                    $.each(response.errors, function (key, value) {
                        $('#' + value.field).css('border-color', '#F64E60');
                        $('#' + value.field + '_error').text(value.error);

                    });//end each
                })
            ;


        });
        $(function () {
            $('.volumeData').change(function () {
                let value = $(this).is(':checked');
                if (value) {

                    $(this).parent().parent().find('.volume_price').attr("required", "true").removeAttr('disabled').show();

                } else {
                    // $(this).parent().parent().find('.volume_price').val('');
                    $(this).parent().parent().find('.volume_price').attr("required", "false").attr("disabled", "disabled").hide();
                }
            });

        });
        
        
        
         $('.styleid').click(function () {
            $("#style").modal('show');
        });
        
        

        $('.addStyle').click(function () {

            var url = '{{route('system.styles.addNewStyle')}}';

            let style_ar = $('input[name=style_ar]');
            let style_en = $('input[name=style_en]');

            var token = '<?= csrf_token() ?>';

            $.post(url,
                {
                    _token: token,
                    name_ar: style_ar.val(),
                    name_en: style_en.val(),
                },

                function (data, status) {

                    if (data) {

                        var container = $('.styleValue');
                        var items = '';
                        $.each(data, function (key, value) {
                            items += '<div class="col-4"><input type="checkbox" name="style[]" value="' + key + '">' + ' ' + value + ' ' + '</div>';
                        });
                        container.append(items);

                        $("#style").modal('hide');
                    } else {

                        alert('هناك خطأ ما');

                    }

                })

                .fail(function (data) {
                    var response = $.parseJSON(data.responseText);

                    $.each(response.errors, function (key, value) {
                        $('#' + value.field).css('border-color', '#F64E60');
                        $('#' + value.field + '_error').text(value.error);

                    });//end each
                })
            ;


        });
        $(function () {
            $('.volumeData').change(function () {
                let value = $(this).is(':checked');
                if (value) {

                    $(this).parent().parent().find('.volume_price').attr("required", "true").removeAttr('disabled').show();

                } else {
                    // $(this).parent().parent().find('.volume_price').val('');
                    $(this).parent().parent().find('.volume_price').attr("required", "false").attr("disabled", "disabled").hide();
                }
            });

        });

    </script>

@endsection


