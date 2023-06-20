<div>
    <div class="col-12 text-center">

        <div class="kt-avatar kt-avatar--outline kt-avatar--success" id="kt_profile_avatar_3">
            <div class="kt-avatar__holder">
                <img src="{{ @$out->image_url }}" alt="user avatar" width="100%" height="100%" />
            </div>

        </div>

    </div>
    <br />
    <div class="row">
        <table class="table table-striped ">
            <tbody>
                <tr>
                    <th> قابل للنقر</th>
                    <td>
                        @if ($out->clickable == 0)
                            <span class="m--font-success"> لا </span>
                        @elseif($out->clickable == 1)
                            <span class="m--font-warning"> نعم </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th> عدد المنتجات المضافة</th>
                    <td>{{ @$out->products()->count() }}</td>
                </tr>

                {{-- <tr> --}}
                {{-- <th> سياسة الارجاع (عربي)</th> --}}
                {{-- <td style="max-height: 200px; max-with:80% !important; overflow: auto; word-break: break-word;">{!! @$out->return_policy_ar  !!} </td> --}}
                {{-- </tr> --}}

                {{-- <tr> --}}
                {{-- <th> سياسة الارجاع (انجليزي)</th> --}}
                {{-- <td style="max-height: 200px; max-with:80% !important; overflow: auto;word-break: break-word;"> {!! @$out->return_policy_en !!}</td> --}}
                {{-- </tr> --}}
                <tr>
                    <th> تاريخ الاضافة </th>
                    <td>{{ @$out->created_at->toDateString() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
