<?php

return [
    ////////////////////////////////--- STATICS ---/////////////////////////////////////////////
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\Home\HomeController::class, 'index'
		]
	],
    ////////////////////////////////--- COLOR ---/////////////////////////////////////////////
	"color_create" => [
		"uri" => "/admin/color/create",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\Color\ColorController::class, 'create'
		]
	],
	"color_add" => [
		"uri" => "/admin/color/add",
		"method" => "POST",
		"action" => [
			\Http\Itso\Admin\Modules\Color\ColorController::class, 'add'
		]
	],
	"color_list" => [
		"uri" => "/admin/color/list",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Color\ColorController::class, 'list'
		]
	],
	"color_view" => [
		"uri" => "/admin/color/view/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'view'
		]
	],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
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
    "customer_list" => [
        "uri" => "/customer/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'list'
        ]
    ],
    ////////////////////////////////--- CONNEXION ---/////////////////////////////////////////////
	"login" => [
		"uri" => "/login",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"logout" => [
		"uri" => "/logout",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Connexion\ConnexionController::class, 'logout'
		]
	],
    ////////////////////////////////--- MARQUES ---/////////////////////////////////////////////
    "brand_list" => [
        "uri" => "/brand/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'list'
        ]
    ],
    "brand_create" => [
        "uri" => "/admin/brand/create",
        "method" => "GET",
        "action" => [
            Http\Itso\Admin\Modules\Brand\BrandController::class, 'create'
        ]
    ],
    "brand_add" => [
        "uri" => "/admin/brand/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'add'
        ]
    ],
    "brand_view" => [
        "uri" => "/brand/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'view'
        ]
    ],
    ////////////////////////////////--- ASSOCIATION ---/////////////////////////////////////////////
    "charity_add" => [
        "uri" => "/charity/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'add'
        ]
    ],
    "charity_edit" => [
        "uri" => "/charity/edit",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'edit'
        ]
    ],
    "charity_update" => [
        "uri" => "/charity/update",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'update'
        ]
    ],
    "charity_view" => [
        "uri" => "/charity/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'view'
        ]
    ],
	"charity_list" => [
        "uri" => "/charity/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'list'
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
];
