<?php

return [
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Home\HomeController::class, 'index'
		]
	],
	"personality" => [
		"uri" => "/personality/{id}",
		"method" => "GET",
		"action" => [
			Http\Itso\Front\Modules\Search\PersonalityController::class, 'index'
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
