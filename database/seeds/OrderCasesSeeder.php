<?php

namespace Database\Seeders;

use App\Models\OrderCase;
use Illuminate\Database\Seeder;

class OrderCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $orderCases =[
            [
                'name_ar'=>'جديد',
                'name_en'=>'New',
                'details_ar'=>'تم ارسال طلبك',
                'details_en'=>'Your Order has been sent',
                'hex_color'=>'#007878',
                'is_active'=>1,
            ],
            [
                'name_ar'=>'ملغي',
                'name_en'=>'Canceled',
                'details_ar'=>'تم إلغاء طلبك',
                'details_en'=>'Your order has been cancelled',
                'hex_color'=>'#32aa32',
                'is_active'=>1,
            ],
            [
                'name_ar'=>"تأكيد",
                'name_en'=>'Confirm order',
                'details_ar'=>'تم تأكيد استلام طلبك ',
                'details_en'=>'Your order has been confirmed',
                'hex_color'=>'#dd0000',
                'is_active'=>1,
            ],
            [
                'name_ar'=>"جاري الشحن",
                'name_en'=>'Shipping in progress',
                'details_ar'=>'جاري شحن طلبك',
                'details_en'=>'Your order is being shipped',
                'hex_color'=>'#dd0000',
                'is_active'=>1,
            ],
            [
                'name_ar'=>"تم الشحن ",
                'name_en'=>'Shipped',
                'details_ar'=>'تم شحن طلبك',
                'details_en'=>'Your order has been shipped',
                'hex_color'=>'#3250aa',
                'is_active'=>1,
            ],
            [
                'name_ar'=>"جاري التوصيل",
                'name_en'=>'Delivery in progress',
                'details_ar'=>'جاري توصيل طلبك',
                'details_en'=>'Your order is being delivered',
                'hex_color'=>'#3250aa',
                'is_active'=>1,
            ],
            [
                'name_ar'=>"تم التوصيل",
                'name_en'=>'Delivered',
                'details_ar'=>'تم توصيل طلبك',
                'details_en'=>'Your order has been delivered',
                'hex_color'=>'#3250aa',
                'is_active'=>1,
            ],
            [
                'name_ar'=>" مرجع",
                'name_en'=>'Returned',
                'details_ar'=>'تم ارجاع طلبك',
                'details_en'=>'Your Order has been returned',
                'hex_color'=>'#3250aa',
                'is_active'=>1,
            ],

        ];
        OrderCase::insert($orderCases);
    }
}
