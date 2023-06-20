<?php

namespace Database\Seeders;

use App\SystemAdmin;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'view_dashboard',
            'add_dashboard',
            'edit_dashboard',
            'delete_dashboard',
            'activate_dashboard',
            'feature_dashboard',
            'slider_dashboard',


            'view_admins',
            'add_admins',
            'edit_admins',
            'delete_admins',
            'activate_admins',
            'feature_admins',
            'slider_admins',


            'view_settings',
            'add_settings',
            'edit_settings',
            'delete_settings',
            'activate_settings',
            'feature_settings',
            'slider_settings',


            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',
            'activate_roles',
            'feature_roles',
            'slider_roles',


            'view_translations',
            'add_translations',
            'edit_translations',
            'delete_translations',
            'activate_translations',
            'feature_translations',
            'slider_translations',


            'view_categories',
            'add_categories',
            'edit_categories',
            'delete_categories',
            'activate_categories',
            'feature_categories',
            'slider_categories',


            'view_colors',
            'add_colors',
            'edit_colors',
            'delete_colors',
            'activate_colors',
            'feature_colors',
            'slider_colors',


            'view_sizes',
            'add_sizes',
            'edit_sizes',
            'delete_sizes',
            'activate_sizes',
            'feature_sizes',
            'slider_sizes',


            'view_stores',
            'add_stores',
            'edit_stores',
            'delete_stores',
            'activate_stores',
            'feature_stores',
            'slider_stores',


            'view_products',
            'add_products',
            'edit_products',
            'delete_products',
            'activate_products',
            'feature_products',
            'slider_products',



            'view_orders',
            'add_orders',
            'edit_orders',
            'delete_orders',
            'activate_orders',
            'feature_orders',
            'slider_orders',


            'view_orderCases',
            'add_orderCases',
            'edit_orderCases',
            'delete_orderCases',
            'activate_orderCases',
            'feature_orderCases',
            'slider_orderCases',


            'view_coupons',
            'add_coupons',
            'edit_coupons',
            'delete_coupons',
            'activate_coupons',
            'feature_coupons',
            'slider_coupons',


            'view_users',
            'add_users',
            'edit_users',
            'delete_users',
            'activate_users',
            'feature_users',
            'slider_users',


            'view_notifications',
            'add_notifications',
            'edit_notifications',
            'delete_notifications',
            'activate_notifications',
            'feature_notifications',
            'slider_notifications',


            'view_contacts',
            'add_contacts',
            'edit_contacts',
            'delete_contacts',
            'activate_contacts',
            'feature_contacts',
            'slider_contacts',


            'view_about_us',
            'add_about_us',
            'edit_about_us',
            'delete_about_us',
            'activate_about_us',
            'feature_about_us',
            'slider_about_us',


            'view_terms',
            'add_terms',
            'edit_terms',
            'delete_terms',
            'activate_terms',
            'feature_terms',
            'slider_terms',


            'view_policies',
            'add_policies',
            'edit_policies',
            'delete_policies',
            'activate_policies',
            'feature_policies',
            'slider_policies',


            'view_payments',
            'add_payments',
            'edit_payments',
            'delete_payments',
            'activate_payments',
            'feature_payments',
            'slider_payments',
            
            'view_govs',
            'add_govs',
            'edit_govs',
            'delete_govs',
            'activate_govs',

            'view_areas',
            'add_areas',
            'edit_areas',
            'delete_areas',
            'activate_areas',

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
