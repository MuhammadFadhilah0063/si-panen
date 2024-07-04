<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SIPANEN',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SIPANEN</b>',
    'logo_img' => '/img/logo dkp.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => '',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 90,
            'height' => 90,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],
        // [
        //     'type'         => 'fullscreen-widget',
        //     'topnav_right' => true,
        // ],

        // Sidebar items:
        ['header' => 'Halaman Utama'],
        [
            'text'    => 'Dashboard',
            'url'     => 'admin/dashboard',
            'icon'    => 'fas fa-tachometer-alt',
            'can'     => "admin-access",
        ],
        [
            'text'    => 'Dashboard',
            'url'     => 'penyuluh/dashboard',
            'icon'    => 'fas fa-tachometer-alt',
            'can'     => "penyuluh-access",
        ],
        [
            'text'    => 'Dashboard',
            'url'     => 'petani/dashboard',
            'icon'    => 'fas fa-tachometer-alt',
            'can'     => "petani-access",
        ],
        [
            'text'        => 'Dashboard Guest',
            'url'         => '',
            'icon'        => 'fas fa-tachometer-alt',
            'can'     => "aluh-access",
        ],
        ['header' => ''],
        ['header' => 'Pendataan'],

        [
            'text'    => 'Berita',
            'icon'    => 'fas fa-globe',
            'url'     => 'admin/berita',
            'can'     => "admin-access",
        ],
        [
            'text'    => 'Data Penyuluh',
            'icon'    => 'fas fa-user-tie',
            'url'     => 'admin/penyuluh',
            'can'     => "admin-access",
        ],
        [
            'text'    => 'Data Penyuluh',
            'icon'    => 'fas fa-user-tie',
            'url'     => 'kabid/penyuluh',
            'can'     => "kabid-access",
        ],
        [
            'text'    => 'Data Petani',
            'icon'    => 'fa-solid fa-tractor',
            'can'     => ["penyuluh-access", 'admin-access', 'petani-access', 'kabid-access'],
            'submenu' => [
                [
                    'text'  => 'Poktan',
                    'url'   => 'admin/poktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "admin-access",

                ],
                [
                    'text'  => 'Gapoktan',
                    'url'   => 'admin/gapoktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Poktan',
                    'url'   => 'penyuluh/poktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "penyuluh-access",

                ],
                [
                    'text'  => 'Gapoktan',
                    'url'   => 'penyuluh/gapoktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "penyuluh-access",
                ],
                [
                    'text'  => 'Poktan',
                    'url'   => 'petani/poktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "petani-access",

                ],
                [
                    'text'  => 'Gapoktan',
                    'url'   => 'petani/gapoktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "petani-access",
                ],
                [
                    'text'  => 'Poktan',
                    'url'   => 'kabid/poktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "kabid-access",

                ],
                [
                    'text'  => 'Gapoktan',
                    'url'   => 'kabid/gapoktan',
                    'icon'  => 'fas fa-user',
                    'can'   => "kabid-access",
                ],
                [
                    'text'    => 'Tambah Data Petani',
                    'icon'    => 'fas fa-plus',
                    'url'     => 'penyuluh/tambah-petani',
                    'can'   => ["penyuluh-access"],
                ],
                [
                    'text'    => 'Tambah Data Petani',
                    'icon'    => 'fas fa-plus',
                    'url'     => 'petani/tambah-petani',
                    'can'   => ["petani-access"],
                ],
            ],
        ],
        [
            'text'    => 'Data Hasil Panen',
            'icon'    => 'fas fa-seedling',
            'can'   => ["admin-access", 'penyuluh-access', 'kabid-access'],
            'submenu' => [
                [
                    'text'  => 'Banjarmasin Tengah',
                    'url'   => 'admin/hasil-panen/daerah/tengah',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Banjarmasin Selatan',
                    'url'   => 'admin/hasil-panen/daerah/selatan',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Banjarmasin Utara',
                    'url'   => 'admin/hasil-panen/daerah/utara',
                    'icon'  => 'fas fa-globe-americas',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Banjarmasin Barat',
                    'url'   => 'admin/hasil-panen/daerah/barat',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Banjarmasin Timur',
                    'url'   => 'admin/hasil-panen/daerah/timur',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Banjarmasin Tengah',
                    'url'   => 'kabid/hasil-panen/daerah/tengah',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "kabid-access",
                ],
                [
                    'text'  => 'Banjarmasin Selatan',
                    'url'   => 'kabid/hasil-panen/daerah/selatan',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "kabid-access",
                ],
                [
                    'text'  => 'Banjarmasin Utara',
                    'url'   => 'kabid/hasil-panen/daerah/utara',
                    'icon'  => 'fas fa-globe-americas',
                    'can'   => "kabid-access",
                ],
                [
                    'text'  => 'Banjarmasin Barat',
                    'url'   => 'kabid/hasil-panen/daerah/barat',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "kabid-access",
                ],
                [
                    'text'  => 'Banjarmasin Timur',
                    'url'   => 'kabid/hasil-panen/daerah/timur',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "kabid-access",
                ],
                /*
    |--------------------------------------------------------------------------
    | Sidebar Penyuluh
    |--------------------------------------------------------------------------
    |
    | Data sidebar untuk akses penyuluh
    |
    */
                [
                    'text'  => 'Banjarmasin Tengah',
                    'url'   => 'penyuluh/hasil-panen/daerah/tengah',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "penyuluh-access",
                ],
                [
                    'text'  => 'Banjarmasin Selatan',
                    'url'   => 'penyuluh/hasil-panen/daerah/selatan',
                    'icon'  => 'fas fa-globe-asia',
                    'can'   => "penyuluh-access",
                ],
                [
                    'text'  => 'Banjarmasin Utara',
                    'url'   => 'penyuluh/hasil-panen/daerah/utara',
                    'icon'  => 'fas fa-globe-americas',
                    'can'   => "penyuluh-access",
                ],
                [
                    'text'  => 'Banjarmasin Barat',
                    'url'   => 'penyuluh/hasil-panen/daerah/barat',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "penyuluh-access",
                ],
                [
                    'text'  => 'Banjarmasin Timur',
                    'url'   => 'penyuluh/hasil-panen/daerah/timur',
                    'icon'  => 'fas fa-globe-africa',
                    'can'   => "penyuluh-access",
                ],
            ],
        ],
        [
            'text'    => 'Tambah Data Panen',
            'icon'    => 'fas fa-plus',
            'url'     => 'admin/hasil-panen/create',
            'can'   => ["admin-access"],
        ],
        [
            'text'    => 'Tambah Data Panen',
            'icon'    => 'fas fa-plus',
            'url'     => 'penyuluh/hasil-panen/create',
            'can'   => ["penyuluh-access"],
        ],
        [
            'text'    => 'Daerah',
            'icon'    => 'fa-solid fa-map',
            'can'     => "admin-access",
            'submenu' => [
                [
                    'text'  => 'Kecamatan',
                    'url'   => 'admin/kecamatan',
                    'icon'  => 'fa-solid fa-map-location-dot',
                    'can'   => "admin-access",
                ],
                [
                    'text'  => 'Kelurahan',
                    'url'   => 'admin/kelurahan',
                    'icon'  => 'fa-solid fa-map-location-dot',
                    'can'   => "admin-access",
                ],
            ],
        ],
        [
            'text'    => 'Export',
            'icon'    => 'fas fa-file-excel',
            'url'     => 'admin/export',
            'can'   => "admin-access",
        ],
        [
            'text'    => 'Export',
            'icon'    => 'fas fa-file-excel',
            'url'     => 'penyuluh/export',
            'can'   => "penyuluh-access",
        ],
        [
            'text'    => 'Export',
            'icon'    => 'fas fa-file-excel',
            'url'     => 'kabid/export',
            'can'   => "kabid-access",
        ],
        [
            'header' => '',
            'can' => 'admin-access',
        ],
        [
            'header' => 'Pegawai',
            'can' => 'admin-access',
        ],
        [
            'text' => 'Data Pegawai',
            'url'  => 'admin/pegawai',
            'icon' => 'fas fa-user',
            'can'  => 'admin-access'
        ],
        [
            'text' => 'Data Pegawai',
            'url'  => 'kabid/pegawai',
            'icon' => 'fas fa-user',
            'can'  => 'kabid-access'
        ],
        [
            'text' => 'Data Jabatan',
            'url'  => 'admin/jabatan',
            'icon' => 'fas fa-user',
            'can'  => 'admin-access'
        ],
        ['header' => ''],
        ['header' => 'Pengaturan Akun'],
        [
            'text' => 'Pengaturan User',
            'url'  => 'admin/user-config',
            'icon' => 'fas fa-cogs',
            'can'  => 'admin-access'
        ],
        [
            'text' => 'profile',
            'url'  => 'admin/profile',
            'icon' => 'fas fa-user',
            'can' => 'admin-access'
        ],
        [
            'text' => 'profile',
            'url'  => 'penyuluh/profile',
            'icon' => 'fas fa-user',
            'can' => 'penyuluh-access'
        ],
        [
            'text' => 'profile',
            'url'  => 'kabid/profile',
            'icon' => 'fas fa-user',
            'can' => 'kabid-access'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
