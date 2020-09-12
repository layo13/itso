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
