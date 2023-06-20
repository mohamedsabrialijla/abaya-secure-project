
{{--        <li wire:sortable.item="{{ $item->id }}" wire:key="task-{{ $item->id  }}">--}}
{{--            <h4 wire:sortable.handle>{{ $task['title'] }}</h4>--}}
{{--            --}}{{--                <button wire:click="removeTask({{$task['id'] }})">Remove</button>--}}
{{--        </li>--}}


        <tbody wire:sortable="updateTaskOrder">

@foreach ($products as $o)
        <tr id="TR_{{$o->id}}" wire:sortable.item="{{ $o->id }}" wire:key="task-{{ $o->id  }}" >

            <td class="LOOPIDS">{{$loop->iteration}}</td>
            <td style="text-align: center;vertical-align: middle;">
                <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                    <input type="checkbox" value="<?= $o->id ?>" name="Item[]" class="CheckedItem"
                           id="che_{{$o->id}}">
                    <span></span>
                </label>
            </td>
            <td class="text-right" >
                <img src="{{$o->image_url}}" class="img_table" alt="">
                {{$o->name}}
            </td>
            <td class="text-center" >
               <span > {{@$o->category->name}}</span>
            </td>
            <td class="text-center"> {{@$o->store->name}}</td>
            <td class="text-center"> @if($o->has_discount) <span
                    class="old_price">{{$o->real_price}}</span>  <span
                    class="new_price">{{$o->price}} {{\App\Models\Settings::get('currency_ar')}}</span>@else {{$o->price}}  {{\App\Models\Settings::get('currency_ar')}}@endif
            </td>

            <td class="text-center">
                @if($o->is_active == 1)
                    <span class="font-success"> مفعل </span>

                @elseif($o->is_active == 0)
                    <span class="font-warning"> معطل </span>
                @else
                    <span class="m--font-warning"> مجهول </span>
                @endif
            </td>
            <td class="text-center"> {{@$o->created_at->toDateString()}}</td>
            <td class="text-center">

                <ul class="list-inline">

                    @if(auth('system_admin')->user()->can('edit_products','system_admin')||auth('system_admin')->user()->can('feature_products','system_admin'))

                        <li>

                            <button type="button"
                                    class="{{config('layout.classes.warning')}}  mt-2 update"
                                    title="تعديل "
                                    data-ar="<?=$o->annotation_ar?>"
                                    data-en="<?=$o->annotation_en?>"
                                    data-feature="{{$o->feature_image_url}}"
                                    data-id="<?= $o->id ?>"
                                    data-url="{{route('system.featureProducts.update')}}"
                                    data-token="{{csrf_token()}}"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                            >
                                <i class="fa fa-edit"></i> تعديل
                            </button>
                        </li>
                        <li>
                            <button type="button"
                                    data-id="<?= $o->id ?>"
                                    data-url="{{route('system.featureProducts.change_show_feature_product')}}"
                                    data-token="{{csrf_token()}}"
                                    data-toggle="tooltip"
                                    data-theme="dark"
                                    data-placement="top"
                                    title="{{$o->is_feature == 1?'اخفاء المنتج من المنتجات المميزة':'عرض المنتج في المنتجات المميزة'}}"
                                    class="{{config('layout.classes.warning')}} mt-2 btn-doAction">
                                <i class="fa fa-eye "></i>
                                {{$o->is_feature == 0?'عرض':'اخفاء'}}
                            </button>
                        </li>
                        <li>
                            <button  type="button" class="{{config('layout.classes.warning')}} btn-icon" wire:sortable.handle>
                                <i class="la la-arrows-v"></i>
                            </button>
                        </li>
                    @endif
                </ul>

            </td>
        </tr>
@endforeach
         </tbody>

