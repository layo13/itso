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
		"uri" => "/color/create",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\Color\ColorController::class, 'create'
		]
	],
	"color_add" => [
		"uri" => "/color/add",
		"method" => "POST",
		"action" => [
			\Http\Itso\Admin\Modules\Color\ColorController::class, 'add'
		]
	],
	"color_list" => [
		"uri" => "/color/list",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\Color\ColorController::class, 'list'
		]
	],
	"color_view" => [
		"uri" => "/color/view,{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'view'
		]
	],
    "color_edit" => [
        "uri" => "/color/edit,{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'edit'
        ]
    ],
    "color_update" => [
        "uri" => "/color/update,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'update'
        ]
    ],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
	"user_create" => [
		"uri" => "/user/create",
		"method" => "GET",
		"action" => [
			Http\Itso\Admin\Modules\User\UserController::class, 'create'
		]
	],
	"user_add" => [
		"uri" => "/user/add",
		"method" => "POST",
		"action" => [
			\Http\Itso\Admin\Modules\User\UserController::class, 'add'
		]
	],
	"user_list" => [
		"uri" => "/user/list",
		"method" => "GET",
		"action" => [
			\Http\Itso\Admin\Modules\User\UserController::class, 'list'
		]
	],
	"user_view" => [
		"uri" => "/user/view,{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'view'
		]
	],
    "user_update" => [
        "uri" => "/user/update,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Admin\Modules\User\UserController::class, 'update'
        ]
    ],
    "user_edit" => [
        "uri" => "/user/edit,{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'edit'
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
        "uri" => "/brand/create",
        "method" => "GET",
        "action" => [
            Http\Itso\Admin\Modules\Brand\BrandController::class, 'create'
        ]
    ],
    "brand_add" => [
        "uri" => "/brand/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'add'
        ]
    ],
    "brand_view" => [
        "uri" => "/brand/view,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'view'
        ]
    ],
    "brand_edit" => [
        "uri" => "/brand/edit,{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'edit'
        ]
    ],
    "brand_update" => [
        "uri" => "/brand/update,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'update'
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
        "uri" => "/charity/edit,{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'edit'
        ]
    ],
    "charity_update" => [
        "uri" => "/charity/update,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'update'
        ]
    ],
    "charity_view" => [
        "uri" => "/charity/view,{id}",
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
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'list'
        ]
    ],
    "product_view" => [
        "uri" => "/product/view,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'view'
        ]
    ],
    "product_update" => [
        "uri" => "/product/update,{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Admin\Modules\Product\ProductController::class, 'update'
        ]
    ],
    "product_edit" => [
        "uri" => "/product/edit,{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'edit'
        ]
    ],
    "product_create" => [
        "uri" => "/product/create",
        "method" => "GET",
        "action" => [
            Http\Itso\Admin\Modules\Product\ProductController::class, 'create'
        ]
    ],
     "product_add" => [
        "uri" => "/product/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'add'
        ]
    ],
    "product_publish" => [
        "uri" => "/product/publish",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'publish'
        ]
    ],
    "category_select" => [
        "uri" => "/category/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'select'
        ]
    ]
];
