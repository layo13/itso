<?php

return [
    ////////////////////////////////--- STATICS ---/////////////////////////////////////////////
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Vip\Modules\Home\HomeController::class, 'index'
		]
	],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
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
	"user_profil" => [
		"uri" => "/user/profil",
		"method" => "GET",
		"action" => [
            \Http\Itso\Vip\Modules\User\UserController::class, 'profil'
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
    ////////////////////////////////--- CONNEXION ---/////////////////////////////////////////////
	"login" => [
		"uri" => "/login",
		"method" => "GET",
		"action" => [
			\Http\Itso\Vip\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"logout" => [
		"uri" => "/logout",
		"method" => "GET",
		"action" => [
			\Http\Itso\Vip\Modules\Connexion\ConnexionController::class, 'logout'
		]
	],
    ////////////////////////////////--- MARQUES ---/////////////////////////////////////////////
	"brand_list" => [
        "uri" => "/brand/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Brand\BrandController::class, 'list'
        ]
    ],
    "brand_view" => [
        "uri" => "/brand/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Brand\BrandController::class, 'view'
        ]
    ],
    ////////////////////////////////--- ASSOCIATION ---/////////////////////////////////////////////
	"charity_list" => [
        "uri" => "/association/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'list'
        ]
    ],
    "charity_view" => [
        "uri" => "/association/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'view'
        ]
    ],
    ////////////////////////////////--- PRODUIT ---/////////////////////////////////////////////
    "product_list" => [
        "uri" => "/product/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Product\ProductController::class, 'list'
        ]
    ],
    "product_view" => [
        "uri" => "/product/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Product\ProductController::class, 'view'
        ]
    ],
    "product_update" => [
        "uri" => "/product/update",
        "method" => "GET",
        "action" => [
            Http\Itso\Vip\Modules\Product\ProductController::class, 'update'
        ]
    ],
    "product_edit" => [
        "uri" => "/product/edit",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Product\ProductController::class, 'edit'
        ]
    ],
    "product_create" => [
        "uri" => "/product/create",
        "method" => "GET",
        "action" => [
            Http\Itso\Vip\Modules\Product\ProductController::class, 'create'
        ]
    ],
    "product_add" => [
        "uri" => "/product/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Product\ProductController::class, 'add'
        ]
    ],
    "category_select" => [
        "uri" => "../../../../itso/vip/category/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Category\CategoryController::class, 'select'
        ]
    ]
];