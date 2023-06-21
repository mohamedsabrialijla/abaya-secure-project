
<div>
    <div class="col-12 text-center">

        <div class="kt-avatar kt-avatar--outline kt-avatar--success"
             id="kt_profile_avatar_3">
            <div class="kt-avatar__holder"
            >
                <img  src="<?php echo e(@$out->image); ?>" alt="user avatar"   style="border-radius: 50%"  width="200" height="110"/>
            </div>

        </div>

    </div>
    <br/>
    <div class="row">
        <table class="table table-striped ">
            <tbody>
            <tr>
                <th>اسم المصمم (عربي)</th>
                <td><?php echo e(@$out->name_ar); ?></td>
            </tr>

            <tr>
                <th>اسم المصمم (انجليزي)</th>
                <td><?php echo e(@$out->name_en); ?></td>
            </tr>
            <tr>
                <th>رقم الجوال</th>
                <td><?php echo e(@$out->mobile); ?></td>
            </tr>

            <tr>
                <th> عدد المنتجات المضافة</th>
                <td><?php echo e(@$out->products()->count()); ?></td>
            </tr>










            <tr>
                <th> تاريخ الاضافة  </th>
                <td><?php echo e(@$out->created_at->toDateString()); ?></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>







<?php /**PATH /home/abayasquare/public_html/resources/views/system_admin/stores/details.blade.php ENDPATH**/ ?>