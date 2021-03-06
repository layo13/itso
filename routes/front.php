<?php

return [
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Home\HomeController::class, 'index'
		]
	],
	"brand" => [
		"uri" => "/brand/{id}",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Search\BrandController::class, 'index'
		]
	],
	///////////////////////////////--- SEARCH ---///////////////////////////////
	"search" => [
		"uri" => "/search",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Search\SearchController::class, 'index'
		]
	],
	"search_exec" => [
		"uri" => "/search",
		"method" => "POST",
		"action" => [
			Http\Itso\Front\Modules\Search\SearchController::class, 'exec'
		]
	],
	////////////////////////////////--- USER ---////////////////////////////////
	"personality_read" => [
		"uri" => "/personality/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'read'
		]
	],
	"personality_favority_read" => [
		"uri" => "/personality/{id}/favorite/{favorite}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
			"favorite" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'readFavorite'
		]
	],
	////////////////////////////////--- BRAND ---///////////////////////////////
	"brand_read" => [
		"uri" => "/brand/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Brand\BrandController::class, 'read'
		]
	],
	"product_read" => [
		"uri" => "/product/{id}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
			"product" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Product\ProductController::class, 'read'
		]
	],
	"personality_product_read" => [
		"uri" => "/personality/{id}/product/{product}",
		"method" => "GET",
		"parameters" => [
			"id" => "[0-9]+",
			"product" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'readProduct'
		]
	],
	"personality_product_get_links_ajax" => [
		"uri" => "/personality/{id}/product/{product}/get/links",
		"method" => "POST",
		"parameters" => [
			"id" => "[0-9]+",
			"product" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'getLinks'
		]
	],
	"personality_suscribe_ajax" => [
		"uri" => "/personality/{id}/suscribe",
		"method" => "POST",
		"parameters" => [
			"id" => "[0-9]+"
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'suscribe'
		]
	],
	"personality_product_read_like_ajax" => [
		"uri" => "/personality/{id}/product/{product}/like",
		"method" => "POST",
		"parameters" => [
			"id" => "[0-9]+",
			"product" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'readProductLike'
		]
	],
	"personality_product_read_add_to_wishlist_ajax" => [
		"uri" => "/personality/{id}/product/{product}/add_to_wishlist",
		"method" => "POST",
		"parameters" => [
			"id" => "[0-9]+",
			"product" => "[0-9]+",
		],
		"action" => [
			\Http\Itso\Front\Modules\Personality\PersonalityController::class, 'readProductAddToWishlist'
		]
	],
	/////////////////////////////--- WISHLIST ---///////////////////////////////
	"wishlist_add" => [
		"uri" => "/wishlist/add",
		"method" => "POST",
		"action" => [
			Http\Itso\Front\Modules\Wishlist\WishlistController::class, 'add'
		]
	],
	"wishlist_add_product" => [
		"uri" => "/wishlist/add/product",
		"method" => "POST",
		"action" => [
			Http\Itso\Front\Modules\Wishlist\WishlistController::class, 'addProduct'
		]
	],
	//////////////////////////////--- PENDERIE ---//////////////////////////////
	"penderie" => [
		"uri" => "/penderie",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Home\HomeController::class, 'penderie'
		]
	],
	//////////////////////////////--- PENDERIE ---//////////////////////////////
	"like" => [
		"uri" => "/like",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Home\HomeController::class, 'like'
		]
	],
	///////////////////////////////--- LOGIN ---////////////////////////////////
	"login" => [
		"uri" => "/login",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"login_exec" => [
		"uri" => "/login",
		"method" => "POST",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'login'
		]
	],
	"logout" => [
		"uri" => "/logout",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'logout'
		]
	],
	"register" => [
		"uri" => "/register",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'register'
		]
	],
	"register_exec" => [
		"uri" => "/register",
		"method" => "POST",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'register'
		]
	],
	"profile" => [
		"uri" => "/profile",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Connexion\ConnexionController::class, 'profile'
		]
	]
];
