<?php
/*
   |--------------------------------------------------------------------------
   | Module Request. Dashboard settings
   |--------------------------------------------------------------------------
   |
   | This setting needs only if you want use module Dashboard
   |
   */

return [
    'category_use' => $category_use = true,
    'sub_items_use' => $sub_items_use = true,
    /*
    |--------------------------------------------------------------------------
    | Module routes_dashboard prefix
    |--------------------------------------------------------------------------
    |
    | This prefix use for generation all routes for module
    |
    */

    'prefix' => 'dashboard/ecommerce',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Can use middleware for access to module page
    |
    */

    'middleware' => ['ecommerce', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Parent category in dashboard
    |--------------------------------------------------------------------------
    |
    | Use for generation module page in dashboard.
    | Use '' if not need parent category
    |
    */

    'menu_parent_category' => '',



    /*
     * Special pagination on dashboard (on/off)
     */
    'pagination_use' => true,


    /*
     * Filter products by categories and brands on dashboard (on/off)
     */
    'filter_use' => true,



    /*
    |---------------------------------------    -----------------------------------
    | Dashboard menu item config
    |--------------------------------------------------------------------------
    |
    | Config new item in dashboard menu
    |
    */

    'menu_item_name' => 'ecommerce',

    'dashboard_menu_item' => [
        'link' => 'dashboard/ecommerce/product',
        'text' => 'Каталог товаров',
        'icon' => 'fa-cubes',
        'subitems' => $sub_items_use ?
            [
                [
                    'link' => 'dashboard/ecommerce/product',
                    'text' => 'Товары',
                    'icon' => 'fa-circle-o text-red',
                    'active_rules' => [
                        'routes_parts'=>[
                            'product::'
                        ]
                    ]
                ],

                [
                    'link' => 'dashboard/ecommerce/category',
                    'text' => 'Категории',
                    'icon' => 'fa-circle-o',
                    'active_rules' => [
                        'routes_parts'=>[
                            'category::'
                        ]
                    ]
                ],

                [
                    'link' => 'dashboard/ecommerce/option-group',
                    'text' => 'Опции товаров',
                    'icon' => 'fa-circle-o',
                    'active_rules' => [
                        'routes_parts'=>[
                            'filter::option-group'
                        ]
                    ]
                ],

                [
                    'link' => 'dashboard/ecommerce/filter',
                    'text' => 'Фильтры',
                    'icon' => 'fa-circle-o',
                    'active_rules' => [
                        'routes_parts'=>[
                            'filter::index',
                            'filter::edit',
                        ]
                    ]
                ],

            ] : [],
    ]
];
