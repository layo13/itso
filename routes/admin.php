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
			\HTTP\ITSO\Admin\UsersController::class, 'view'
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
	]
];
