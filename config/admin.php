<?php
return [
    'view'=>[
        'prefix'=>'admin',
        'page_count'=>5
    ],
    'thumb'=>[
        'y'=>0,
        'x'=>0,
        'position'=>'bottom-left',
        'font'=>[
            'size'=>15,
            'color'=>'#ffffff',
            'ttf'=>'SourceHanSansCN-Normal.otf',
        ],
        'text'=>'我的cms,我做主',
    ],
    'route'=>[
        'prefix'=>'admin',
    ],
    'permission'=>[
        'check'=>true,
        // 'excepts'=>[
        //     '/login'
        // ],
        ],
    'database' => [
        'role_table' => 'roles',
        'roles_model' => App\Models\Role::class,

        'role_menu_table' => 'role_menu',
    ]
];