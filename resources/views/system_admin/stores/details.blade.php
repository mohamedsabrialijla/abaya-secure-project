
<div>
    <div class="col-12 text-center">

        <div class="kt-avatar kt-avatar--outline kt-avatar--success"
             id="kt_profile_avatar_3">
            <div class="kt-avatar__holder"
            >
                <img  src="{{@$out->image}}" alt="user avatar"   style="border-radius: 50%"  width="200" height="110"/>
            </div>

        </div>

    </div>
    <br/>
    <div class="row">
        <table class="table table-striped ">
            <tbody>
            <tr>
                <th>اسم المصمم (عربي)</th>
                <td>{{ @$out->name_ar }}</td>
            </tr>

            <tr>
                <th>اسم المصمم (انجليزي)</th>
                <td>{{ @$out->name_en }}</td>
            </tr>
            <tr>
                <th>رقم الجوال</th>
                <td>{{ @$out->mobile }}</td>
            </tr>

            <tr>
                <th> عدد المنتجات المضافة</th>
                <td>{{ @$out->products()->count() }}</td>
            </tr>

{{--            <tr>--}}
{{--                <th> سياسة الارجاع (عربي)</th>--}}
{{--                <td style="max-height: 200px; max-with:80% !important; overflow: auto; word-break: break-word;">{!! @$out->return_policy_ar  !!} </td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <th> سياسة الارجاع (انجليزي)</th>--}}
{{--                <td style="max-height: 200px; max-with:80% !important; overflow: auto;word-break: break-word;"> {!! @$out->return_policy_en !!}</td>--}}
{{--            </tr>--}}
            <tr>
                <th> تاريخ الاضافة  </th>
                <td>{{ @$out->created_at->toDateString()}}</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>







