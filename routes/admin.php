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
		"uri" => "/color/view/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'view'
		]
	],
    "color_edit" => [
        "uri" => "/color/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'edit'
        ]
    ],
    "color_update" => [
        "uri" => "/color/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Color\ColorController::class, 'update'
        ]
    ],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
	"vip_create" => [
		"uri" => "/vip/create",
		"method" => "GET",
		"action" => [
		//	Http\Itso\Admin\Modules\User\UserController::class, 'createVip'
			Http\Itso\Admin\Modules\User\UserController::class, 'create'
		]
	],
	"vip_add" => [
		"uri" => "/vip/add",
		"method" => "POST",
		"action" => [
			//\Http\Itso\Admin\Modules\User\UserController::class, 'addVip'
			\Http\Itso\Admin\Modules\User\UserController::class, 'add'
		]
	],
	"vip_list" => [
		"uri" => "/vip/list",
		"method" => "GET",
		"action" => [
			//\Http\Itso\Admin\Modules\User\UserController::class, 'listVip'
			\Http\Itso\Admin\Modules\User\UserController::class, 'list'
		]
	],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
	"customer_create" => [
		"uri" => "/customer/create",
		"method" => "GET",
		"action" => [
		//	Http\Itso\Admin\Modules\User\UserController::class, 'createCustomer'
			Http\Itso\Admin\Modules\User\UserController::class, 'create'
		]
	],
	"customer_add" => [
		"uri" => "/customer/add",
		"method" => "POST",
		"action" => [
			//\Http\Itso\Admin\Modules\User\UserController::class, 'addCustomer'
			\Http\Itso\Admin\Modules\User\UserController::class, 'add'
		]
	],
	"customer_list" => [
		"uri" => "/customer/list",
		"method" => "GET",
		"action" => [
			//\Http\Itso\Admin\Modules\User\UserController::class, 'listCustomer'
			\Http\Itso\Admin\Modules\User\UserController::class, 'list'
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
		"uri" => "/user/view/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'view'
		]
	],
    "user_update" => [
        "uri" => "/user/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Admin\Modules\User\UserController::class, 'update'
        ]
    ],
    "user_connect" => [
        "uri" => "/user/connect/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Admin\Modules\User\UserController::class, 'connect'
        ]
    ],
    "user_edit" => [
        "uri" => "/user/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\User\UserController::class, 'edit'
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
    "selection_list" => [
        "uri" => "/selection/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Selection\SelectionController::class, 'list'
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
        "uri" => "/brand/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'view'
        ]
    ],
    "brand_edit" => [
        "uri" => "/brand/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'edit'
        ]
    ],
    "brand_update" => [
        "uri" => "/brand/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Brand\BrandController::class, 'update'
        ]
    ],
    ////////////////////////////////--- ASSOCIATION ---/////////////////////////////////////////////
    "charity_create" => [
        "uri" => "/charity/create",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'create'
        ]
    ],
    "charity_add" => [
        "uri" => "/charity/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'add'
        ]
    ],
    "charity_edit" => [
        "uri" => "/charity/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Charity\CharityController::class, 'edit'
        ]
    ],
    "charity_update" => [
        "uri" => "/charity/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
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
    ////////////////////////////////--- FAVORIE ---/////////////////////////////////////////////
    "favorite_create" => [
        "uri" => "/favorite/create",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'create'
        ]
    ],
    "favorite_add" => [
        "uri" => "/favorite/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'add'
        ]
    ],
    "favorite_edit" => [
        "uri" => "/favorite/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'edit'
        ]
    ],
    "favorite_update" => [
        "uri" => "/favorite/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'update'
        ]
    ],
    "favorite_view" => [
        "uri" => "/favorite/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'view'
        ]
    ],
	"favorite_list" => [
        "uri" => "/favorite/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'list'
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
        "uri" => "/product/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Admin\Modules\Product\ProductController::class, 'view'
        ]
    ],
    "product_update" => [
        "uri" => "/product/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Admin\Modules\Product\ProductController::class, 'update'
        ]
    ],
    "product_edit" => [
        "uri" => "/product/edit/{id}",
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
    /**
     * AJAX
     */
    "favorite_list_by_user" => [
        "uri" => "/favorite/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'listByUser'
        ]
    ],
    "favorite_add_favorite" => [
        "uri" => "/favorite/add_favorite",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'addFavorite'
        ]
    ],
    "favorite_add_category_favorite" => [
        "uri" => "/favorite/category_favorite",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Favorite\FavoriteController::class, 'addCategoryAndFavorite'
        ]
    ],
    "category_select" => [
        "uri" => "/category/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Admin\Modules\Category\CategoryController::class, 'select'
        ]
    ]
];
