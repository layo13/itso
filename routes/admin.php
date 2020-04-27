<?php

return [
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\Home\HomeController::class, 'index'
		]
	],
	"user_create" => [
		"uri" => "/admin/user/create",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\User\UserController::class, 'create'
		]
	],
	"user_add" => [
		"uri" => "/admin/user/add",
		"method" => "POST",
		"action" => [
			\Http\Itso\Admin\Modules\User\UserController::class, 'add'
		]
	],
	"user_list" => [
		"uri" => "/admin/user/list",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\User\UserController::class, 'list'
		]
	],
	"user_view" => [
		"uri" => "/admin/user/view/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'view'
		]
	],
	////////////////////////////////////////////////////////////////////////////
	"login" => [
		"uri" => "/login",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"login" => [
		"uri" => "/logout",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Connexion\ConnexionController::class, 'logout'
		]
	],

    /////////////////////////////////////////////////////////////////////////////
	"user_list" => [
        "uri" => "/user/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'list'
        ]
    ],
	"customer_list" => [
        "uri" => "/customer/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'list'
        ]
    ],
	"brand_list" => [
        "uri" => "/brand/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'list'
        ]
    ],

    "association_add" => [
        "uri" => "/association/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Association\AssociationController::class, 'add'
        ]
    ],
	"association_list" => [
        "uri" => "/association/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Association\AssociationController::class, 'list'
        ]
    ]
];
