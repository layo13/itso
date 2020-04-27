<?php

return [
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Vip\Modules\Home\HomeController::class, 'index'
		]
	],
	"user_list" => [
		"uri" => "/admin/user/list",
		"method" => "GET",
		"action" => [
			\Http\Itso\Vip\Modules\User\UserController::class, 'list'
		]
	],
	"user_view" => [
		"uri" => "/admin/user/view/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Vip\Modules\User\UserController::class, 'view'
		]
	],

    "user_update" => [
        "uri" => "/admin/user/update",
        "method" => "GET",
        "action" => [
            Http\Itso\Vip\Modules\User\UserController::class, 'update'
        ]
    ],
    "user_edit" => [
        "uri" => "/admin/user/edit",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\User\UserController::class, 'edit'
        ]
    ],
	////////////////////////////////////////////////////////////////////////////
	"login" => [
		"uri" => "/login",
		"method" => "GET",
		"action" => [
			\Http\Itso\Vip\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"login" => [
		"uri" => "/logout",
		"method" => "GET",
		"action" => [
			\Http\Itso\Vip\Modules\Connexion\ConnexionController::class, 'logout'
		]
	],

    /////////////////////////////////////////////////////////////////////////////
	"brand_list" => [
        "uri" => "/brand/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Brand\BrandController::class, 'list'
        ]
    ],

	"association_list" => [
        "uri" => "/association/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'list'
        ]
    ]
];
