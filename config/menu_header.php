<?php
// Header menu
return [

    'items' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ]
    ],


    'admins' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'الادارة',
            'root' => true,
            'route' => 'system.admin.index',
            'new-tab' => false,
            'module_name' => 'admins',
        ],
        [
            'title' => 'اضافة مدير',
            'root' => true,
            'route' => 'system.admin.create',
            'new-tab' => false,
            'module_name' => 'admins',
            'module_action' => 'add',

        ],
    ],
    'areas' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
//        [
//            'title' => 'المدن والمحافظات',
//            'root' => true,
//            'route' => 'system.areas.index',
//            'new-tab' => false,
//            'module_name' => 'areas',
//        ],
        [
            'title' => 'اضافة مدينة او محافظة',
            'root' => true,
            'route' => 'system.areas.create',
            'new-tab' => false,
            'module_name' => 'areas',
            'module_action' => 'add',

        ],
    ],
    'roles' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'الصلاحيات',
            'root' => true,
            'route' => 'system.roles.index',
            'new-tab' => false,
            'module_name' => 'roles',
        ],
        [
            'title' => 'اضافة صلاحية',
            'root' => true,
            'route' => 'system.roles.create',
            'new-tab' => false,
            'module_name' => 'roles',
            'module_action' => 'add',

        ],
    ],
    'payments' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'طرق الدفع',
            'root' => true,
            'route' => 'system.payments.index',
            'new-tab' => false,
            'module_name' => 'payments',
        ],
        [
            'title' => 'اضافة طريقة دفع',
            'root' => true,
            'route' => 'system.payments.create',
            'new-tab' => false,
            'module_name' => 'payments',
            'module_action' => 'add',

        ],
    ],
    'categories' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'التصنيفات',
            'root' => true,
            'route' => 'system.categories.index',
            'new-tab' => false,
            'module_name' => 'categories',
        ],
        [
            'title' => 'اضافة تصنيف',
            'root' => true,
            'route' => 'system.categories.create',
            'new-tab' => false,
            'module_name' => 'categories',
            'module_action' => 'add',

        ],
    ],
    'products' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'المنتجات',
            'root' => true,
            'route' => 'system.products.index',
            'new-tab' => false,
            'module_name' => 'products',
        ],
        [
            'title' => 'اضافة منتج',
            'root' => true,
            'route' => 'system.products.create',
            'new-tab' => false,
            'module_name' => 'products',
            'module_action' => 'add',

        ],
    ],
    'colors' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'الالوان',
            'root' => true,
            'route' => 'system.colors.index',
            'new-tab' => false,
            'module_name' => 'colors',
        ],
        [
            'title' => 'اضافة لون',
            'root' => true,
            'route' => 'system.colors.create',
            'new-tab' => false,
            'module_name' => 'colors',
            'module_action' => 'add',

        ],
    ],
    'sizes' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'المقاسات',
            'root' => true,
            'route' => 'system.sizes.index',
            'new-tab' => false,
            'module_name' => 'sizes',
        ],
        [
            'title' => 'اضافة مقاس',
            'root' => true,
            'route' => 'system.sizes.create',
            'new-tab' => false,
            'module_name' => 'sizes',
            'module_action' => 'add',

        ],
    ],

    'designers' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'المصممون',
            'root' => true,
            'route' => 'system.stores.index',
            'new-tab' => false,
            'module_name' => 'stores',
        ],
        [
            'title' => 'اضافة مصمم',
            'root' => true,
            'route' => 'system.stores.create',
            'new-tab' => false,
            'module_name' => 'stores',
            'module_action' => 'add',

        ],
    ],
    'coupons' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'أكواد الخصم',
            'root' => true,
            'route' => 'system.coupons.index',
            'new-tab' => false,
            'module_name' => 'coupons',
        ],
        [
            'title' => 'اضافة كود خصم',
            'root' => true,
            'route' => 'system.coupons.create',
            'new-tab' => false,
            'module_name' => 'coupons',
            'module_action' => 'add',
        ],
    ],
    'orderCases' => [
        [
            'title' => 'لوحة التحكم',
            'root' => true,
            'route' => 'system_admin.dashboard',
            'new-tab' => false,
        ],
        [
            'title' => 'حالات الطلب',
            'root' => true,
            'route' => 'system.orderCases.index',
            'new-tab' => false,
            'module_name' => 'orderCases',
        ],
        [
            'title' => 'اضافة حالة طلب',
            'root' => true,
            'route' => 'system.orderCases.create',
            'new-tab' => false,
            'module_name' => 'orderCases',
            'module_action' => 'add',
        ],
    ],


];
