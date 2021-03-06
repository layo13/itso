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
	"contact" => [
		"uri" => "/contact",
		"method" => "GET",
		"action" => [
			Http\Itso\Vip\Modules\Home\HomeController::class, 'contact'
		]
	],
    ////////////////////////////////--- USER ---/////////////////////////////////////////////
	"user_profil" => [
		"uri" => "/user/profil",
		"method" => "GET",
		"action" => [
            \Http\Itso\Vip\Modules\User\UserController::class, 'profil'
		]
	],
    "user_update" => [
        "uri" => "/user/update",
        "method" => "GET",
        "action" => [
            Http\Itso\Vip\Modules\User\UserController::class, 'update'
        ]
    ],
    "user_edit" => [
        "uri" => "/user/edit",
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
        "uri" => "/charity/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'list'
        ]
    ],
	"charity_choice" => [
        "uri" => "/charity/choix",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'update'
        ]
    ],
	"charity_edit" => [
        "uri" => "/charity/edit",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Charity\CharityController::class, 'edit'
        ]
    ],
    "charity_view" => [
        "uri" => "/charity/view/{id}",
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
        "uri" => "/product/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            Http\Itso\Vip\Modules\Product\ProductController::class, 'update'
        ]
    ],
    "product_edit" => [
        "uri" => "/product/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
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
    "product_publish" => [
        "uri" => "/product/publish",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Product\ProductController::class, 'publish'
        ]
    ],
    ////////////////////////////////--- FAVORIE ---/////////////////////////////////////////////
    "favorite_create" => [
        "uri" => "/favorite/create",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'create'
        ]
    ],
    "favorite_add" => [
        "uri" => "/favorite/add",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'add'
        ]
    ],
    "favorite_edit" => [
        "uri" => "/favorite/edit/{id}",
        "method" => "POST",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'edit'
        ]
    ],
    "favorite_update" => [
        "uri" => "/favorite/update/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'update'
        ]
    ],
    "favorite_view" => [
        "uri" => "/favorite/view/{id}",
        "method" => "GET",
        "parameters" => [
            "id" => "[0-9]+",
        ],
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'view'
        ]
    ],
    "favorite_list" => [
        "uri" => "/favorite/list",
        "method" => "GET",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'list'
        ]
    ],
    /**
     * AJAX
     */
    "favorite_list_by_user" => [
        "uri" => "/favorite/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'listByUser'
        ]
    ],
    "favorite_add_favorite" => [
        "uri" => "/favorite/add_favorite",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'addFavorite'
        ]
    ],
    "favorite_add_category_favorite" => [
        "uri" => "/favorite/category_favorite",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Favorite\FavoriteController::class, 'addCategoryAndFavorite'
        ]
    ],
    "category_select" => [
        "uri" => "/vip/category/select",
        "method" => "POST",
        "action" => [
            \Http\Itso\Vip\Modules\Category\CategoryController::class, 'select'
        ]
    ]
];
