@extends('layouts.admin')
@section('breadcrumbs')
    <x-breadcrumbs :breadcrumbs="[
        ['page'=>route('system_admin.dashboard'),'title'=>'الصفحة الرئيسية'],
        ['page'=>route('system.admin.index'),'title'=>'الادارة']
        ]"/>
@endsection
@section('head')

@endsection
@section('page_content')








    @component('components.ShowCardWithBtn',[
'Disname'=>'الادارة',
'Disinfo'=>'تعديل صلاحيات المدير',
'add_url'=>'system.admin.index',
'module'=>'admins',
'actions'=>[]
])
        <div class="row">

            <table class="table">
                <thead>
                <tr>
                    <th style="text-align: center">اسم القسم</th>

                    <?php foreach($rules as $r){ ?>
                    <th style="text-align: center"><?=$r->namear?></th>
                    <?php } ?>
                    <th style="text-align: center">فعل</th>
                    <th style="text-align: center">عطل</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($modules as $a){ ?>
                <tr>
                    <td  style="text-align: center"><?=$a->namear?>
                    </td>

                    <?php foreach($rules as $r){ ?>
                    <td  style="text-align: center">

                        <?php $name='can'.$r->id; ?>
                        @if($a->$name)
                            <label class="checkbox checkbox-outline checkbox-success justify-content-center">
                                <input type="checkbox" class="rule" data-rule="<?=$r->id?>" data-module="<?=$a->id?>"
                                       @if($adminrule=$user->Rules()->where('rule_id',$r->id)->where('module_id',$a->id)->first())
                                       checked
                                       data-ruleid="<?=$adminrule->id ?>"
                                    @endif
                                >
                                <span></span>
                            </label>
                        @else
                            <label class="checkbox checkbox-outline checkbox-success justify-content-center checkbox-disabled">
                                <input type="checkbox">
                                <span></span>
                            </label>
                        @endif
                    </td>
                    <?php } ?>
                    <td style="width: 5%;">
                        <a href="#" class="reg-all" style="padding: 5px;margin: 0 5px;"
                           data-skin="dark" data-tooltip="m-tooltip" data-placement="top" title="فعل الجميع"><i class="fa fa-check"></i> </a>
                    </td>
                    <td style="width: 5%;">
                        <a href="#" class="de-reg-all" style="padding: 5px;margin: 0 5px;"
                           data-skin="dark" data-tooltip="m-tooltip" data-placement="top" title="عطل الجميع"><i class="fa fa-times"></i> </a>
                    </td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>


    @endcomponent




@endsection

@section('custom_scripts')


    <script>
        $(function () {
            $('.reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function(i){
                    var IsCheck=$(this).is(":checked");
                    if(! IsCheck) {
                        $(this).click();
                    }
                });
            });
            $('.de-reg-all').click(function (e) {
                e.preventDefault();
                $(this).parent().parent().find('.rule').each(function(i){
                    var IsCheck=$(this).is(":checked");
                    if(IsCheck) {
                        $(this).click();
                    }
                });
            });
            $(".rule").click(function () {
                var User='<?=$user->id?>';
                var Rule=$(this).data('rule');
                var Module=$(this).data('module');
                var IsCheck=$(this).is(":checked");
                var where=$(this);
                if(! IsCheck){
                    var ruleID=$(this).data('ruleid');
                }else{
                    var ruleID=0;

                }
                console.log(IsCheck,ruleID);
                $.post("{{route('system.admin.do.permission')}}",
                    {
                        _token: '<?=csrf_token()?>',
                        User: User,
                        Rule: Rule,
                        Module: Module,
                        IsCheck: IsCheck,
                        ruleID: ruleID,
                    },
                    function (data, status) {
                        if (data.done == 'true') {
                            where.data('ruleid', data.id);
                        } else {
                        }
                    });

            });
        })
    </script>

@endsection


