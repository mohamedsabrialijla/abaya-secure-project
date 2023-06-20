<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'الصفحة الرئيسية',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'route' =>'system_admin.dashboard',
            'module_name'=>'dashboard',
            'permission_name'=>'view_dashboard',
            'new-tab' => false,
        ],
        // [
        //     'title' => 'المدفوعات',
        //     'icon' => 'media/svg/icons/Shopping/Money.svg',
        //     'route' =>'system.payouts.index',
        //     'new-tab' => false,
        //     'module_name'=>'payouts',
        //     'permission_name'=>'view_stores',
        // ],
        [
            'section' => 'خصائص التطبيق',
        ],
        [
            'title' => 'المصممون',
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'route' =>'system.stores.index',
            'new-tab' => false,
            'module_name'=>'stores',
            'permission_name'=>'view_stores',
        ],
        [
            'title' => 'العروض',
            'icon' => 'media/svg/icons/Shopping/Sale1.svg',
            'route' =>'system.offers.index',
            'new-tab' => false,
            'module_name'=>'offers',
            'permission_name'=>'view_stores',
        ],
        [
            'title' => 'السلايدرز',
            'icon' => 'media/svg/icons/Files/Pictures1.svg',
            'route' =>'system.sliders.index',
            'new-tab' => false,
            'module_name'=>'sliders',
            'permission_name'=>'view_stores',
        ],
        [
            'title' => 'كبونات الخصم',
            'icon' => 'media/svg/icons/Shopping/Sale2.svg',
            'route' =>'system.coupons.index',
            'new-tab' => false,
            'module_name'=>'coupons',
            'permission_name'=>'view_coupons',
        ],
        [
            'title' => 'المنتجات',
            'icon' => 'media/svg/icons/Shopping/Cart2.svg',
            'route' =>'system.products.index',
            'new-tab' => false,
            'module_name'=>'products',
            'permission_name'=>'view_products',
        ],
        [
            'title' => 'المنتجات المميزة',
            'icon' => 'media/svg/icons/Shopping/Cart3.svg',
            'route' =>'system.featureProducts.index',
            'new-tab' => false,
            'module_name'=>'featureProducts',
            'permission_name'=>'view_products',
        ],
        [
            'title' => 'المنتجات الأكثر مبيعا',
            'icon' => 'media/svg/icons/Shopping/Bag2.svg',
            'route' =>'system.sliderProducts.index',
            'new-tab' => false,
            'module_name'=>'sliderProducts',
            'permission_name'=>'view_products',
        ],
        [
            'title' => 'الطلبات',
            'icon' => 'media/svg/icons/Shopping/Cart1.svg',
            'route' =>'system.orders.mainIndex',
            'new-tab' => false,
            'module_name'=>'orders',
            'permission_name'=>'view_orders',
            'search_pattern'=>'orders',
            'active_subs'=>[
                'system.orders.mainIndex',
                'system.orders.index',
            ]
        ],

        //   [
        //       'title' => 'المحفظة',
        //       'icon' => 'media/svg/icons/Shopping/Wallet.svg',
        //       'route' =>'system.balance.index',
        //       'new-tab' => false,
        //       'module_name'=>'balance',
        //   ],
        [
            'title' => 'الزبائن',
            'icon' => 'media/svg/icons/General/User.svg',
            'route' =>'system.users.index',
            'new-tab' => false,
            'module_name'=>'users',
            'permission_name'=>'view_users',
        ],
        [
            'title' => 'الزبائن الأكثر شراءً',
            'icon' => 'media/svg/icons/General/User.svg',
            'route' =>'system.users.mostcustomers',
            'new-tab' => false,
            'module_name'=>'mostcustomers',
            'permission_name'=>'view_users',
        ],
        [
            'title' => 'الاشعارات',
            'icon' => 'media/svg/icons/General/Notifications1.svg',
            'route' =>'system.notifications.index',
            'new-tab' => false,
            'module_name'=>'notifications',
            'permission_name'=>'view_notifications',
        ],
//        [
//            'title' => 'تواصل معنا',
//            'icon' => 'media/svg/icons/Communication/Contact1.svg',
//            'route' =>'system.contacts.index',
//            'new-tab' => false,
//            'module_name'=>'contacts',
//            'permission_name'=>'view_contacts',
//        ],


        // Custom
        [
            'section' => 'إعدادات التطبيق',
        ],
        [
            'title' => 'الاعدادات',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'route' =>'system.settings.index',
            'new-tab' => false,
            'module_name'=>'settings',
            'permission_name'=>'view_settings',

        ],
        [
            'title' => 'الخصائص العامة',
            'icon' => 'media/svg/icons/General/Attachment1.svg',
            'route' =>'system_admin.generalProperties',
            'new-tab' => false,
            'module_name'=>['generalProperties','categories','categories_special','colors','sizes'],
            'permission_name'=>['view_categories','view_colors','view_sizes'],
            'search_pattern'=>'generalProperties',
            'active_subs'=>[
                'system.categories.index',
                'system.categories_special.index',
                'system.colors.index',
                'system.sizes.index',
            ]
        ],
        [
            'title' => 'اعدادات شاشة سبلاش ',
            'icon' => 'media/svg/icons/Shopping/Sort2.svg',
            'route' =>'system.splash.index',
            'new-tab' => false,
//            'module_name'=>'orderCases',
//            'permission_name'=>'view_orderCases',
        ],
        [
            'title' => 'حالات الطلب',
            'icon' => 'media/svg/icons/Shopping/Sort2.svg',
            'route' =>'system.orderCases.index',
            'new-tab' => false,
            'module_name'=>'orderCases',
            'permission_name'=>'view_orderCases',
        ],
        [
            'title' => 'طرق الدفع',
            'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
            'route' =>'system.payments.index',
            'new-tab' => false,
            'module_name'=>'payments',
            'permission_name'=>'view_payments',
        ],
        [
            'title' => 'كلمات البحث مصممين',
            'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
            'route' =>'system.search.log.designer.index',
            'new-tab' => false,
            'module_name'=>'search_log',
            'permission_name'=>'view_designers_search_log',
        ],
        [
            'title' => 'كلمات البحث المنتجات',
            'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
            'route' =>'system.search.log.products.index',
            'new-tab' => false,
            'module_name'=>'search_log',
            'permission_name'=>'view_products_search_log',
        ],
//         [
//             'title' => 'صور سلايدر الموقع',
//             'icon' => 'media/svg/icons/Shopping/Credit-card.svg',
//             'route' =>'system.slider.index',
//             'new-tab' => false,
// //            'module_name'=>'payments',
// //            'permission_name'=>'view_payments',
//         ],


       /* [
            'title' => 'النصوص',
            'icon' => 'media/svg/icons/Code/Code.svg',
            'route' =>'system.translations.index',
            'new-tab' => false,
            'module_name'=>'translations',
            'permission_name'=>'view_translations',

        ],*/

//        [
//            'title' => 'المحافظات والمدن',
//            'icon' => 'media/svg/icons/Home/Globe.svg',
//            'route' =>'system.areas.index',
//            'new-tab' => false,
//            'module_name'=>'areas',
//
//        ],

//        [
//            'title' => 'الحسابات',
//            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
//            'route' =>'system.transactions.index',
//            'new-tab' => false,
//            'module_name'=>'transactions',
//        ],
        [
            'title' => 'عن التطبيق',
            'icon' => 'media/svg/icons/Communication/Write.svg',
            'route' =>'system.settings.getAbout',
            'new-tab' => false,
            'module_name'=>'about_us',
            'permission_name'=>'view_about_us',
        ],[
            'title' => 'الشروط والاحكام',
            'icon' => 'media/svg/icons/Communication/Thumbtack.svg',
            'route' =>'system.settings.getTerms',
            'new-tab' => false,
            'module_name'=>'terms_and_conditions',
            'permission_name'=>'view_terms',

        ],[
            'title' => 'سياسة الخصوصية',
            'icon' => 'media/svg/icons/Communication/Flag.svg',
            'route' =>'system.settings.getPolicy',
            'new-tab' => false,
            'module_name'=>'privacy_and_policy',
            'permission_name'=>'view_policies',
        ],
        [
            'section' => 'إعدادات لوحة التحكم',
        ],
        [
            'title' => 'الادارة',
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'route' => 'system.admin.index',
            'new-tab' => false,
            'module_name'=>'admins',
            'permission_name'=>'view_admins',


        ],
        [
            'title' => 'الصلاحيات',
            'icon' => 'media/svg/icons/General/Lock.svg',
            'route' => 'system.roles.index',
            'new-tab' => false,
            'module_name'=>'roles',
            'permission_name'=>'view_roles',

        ],
//        [
//            'title' => 'Miscellaneous',
//            'icon' => 'media/svg/icons/Home/Mirror.svg',
//            'bullet' => 'dot',
//            'root' => true,
//            'submenu' => [
//                [
//                    'title' => 'Kanban Board',
//                    'page' => 'features/miscellaneous/kanban-board'
//                ],
//                [
//                    'title' => 'Sticky Panels',
//                    'page' => 'features/miscellaneous/sticky-panels'
//                ],
//                [
//                    'title' => 'Block UI',
//                    'page' => 'features/miscellaneous/blockui'
//                ],
//                [
//                    'title' => 'Perfect Scrollbar',
//                    'page' => 'features/miscellaneous/perfect-scrollbar'
//                ],
//                [
//                    'title' => 'Tree View',
//                    'page' => 'features/miscellaneous/treeview'
//                ],
//                [
//                    'title' => 'Bootstrap Notify',
//                    'page' => 'features/miscellaneous/bootstrap-notify'
//                ],
//                [
//                    'title' => 'Toastr',
//                    'page' => 'features/miscellaneous/toastr'
//                ],
//                [
//                    'title' => 'SweetAlert2',
//                    'page' => 'features/miscellaneous/sweetalert2'
//                ],
//                [
//                    'title' => 'Dual Listbox',
//                    'page' => 'features/miscellaneous/dual-listbox'
//                ],
//                [
//                    'title' => 'Session Timeout',
//                    'page' => 'features/miscellaneous/session-timeout'
//                ],
//                [
//                    'title' => 'Idle Timer',
//                    'page' => 'features/miscellaneous/idle-timer'
//                ]
//            ]
//        ]
    ]

];
