<?php

use App\Models\OrderCase;
use App\SystemAdmin;
use Database\Seeders\OrderCasesSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SettingsSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(PermissionSeeder::class);
        $this->addNewPermission();
        // $this->call(UsersTableSeeder::class);
//        $this->call(PermissionSeeder::class);
//        $this->call(OrderCasesSeeder::class);
//        $this->call(SettingsSeeder::class);
//        OrderCase::updateOrCreate(
//            ['name_ar'=>'في انتظار الدفع','name_en'=>'Waiting for payment'],
//            [
//            'name_ar'=>'في انتظار الدفع',
//            'name_en'=>'Waiting for payment',
//            'hex_color'=>'#32aa32',
//            'is_active'=>true,
//            'details_ar'=>'تم استلام طلبك وفي انتظار الدفع',
//            'details_en'=>'Your order has been received and is awaiting payment',
//            ]
//        );
    }

    public function addNewPermission(){

        $permissions=[
            'view_search_log',
            'delete_search_log',
            'add_search_log',
            'edit_search_log',
            'activate_search_log',
            'feature_search_log',
            'slider_search_log',
        ];
        foreach ($permissions as $permission) {

            Permission::updateOrCreate(['name' => $permission,
                'guard_name'=>'system_admin'
            ],['name' => $permission,
                'guard_name'=>'system_admin'
            ]);
        }

        $role = Role::updateOrCreate(['name' => 'Super Admin','guard_name' => 'system_admin']);

        $permissions = Permission::where('guard_name','system_admin')->pluck('id')->toArray();

        $role->syncPermissions($permissions);

        $n= SystemAdmin::find(1);
        if($n){
            $n->assignRole($role);
        }
    }
}
