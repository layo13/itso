<?php

return [
    "user_create" => [
        "uri" => "/user/create",
        "method" => "GET",
        "action" => [
            \ITSO\Admin\UsersController::class, 'create'
        ]
    ],
    "user_add" => [
        "uri" => "/user/add",
        "method" => "POST",
        "action" => [
            \ITSO\Admin\UsersController::class, 'add'
        ]
    ],
    "user_list" => [
        "uri" => "/user/list",
        "method" => "GET",
        "action" => [
            \ITSO\Admin\UsersController::class, 'list'
        ]
    ],





	"admin_blog_home" => [
		"uri" => "/admin/blog",
		"method" => "GET",
		"action" => [
			\ITSO\Admin\BlogController::class, 'home'
		]
	],
	"admin_category_home" => [
		"uri" => "/admin/category",
		"method" => "GET",
		"action" => [
			\ITSO\Admin\CategoryController::class, 'home'
		]
	],
	"home" => [
		"uri" => "/",
		"method" => "GET",
		"action" => function() {
			return "In The Showes Of";
		}
	],
	"hello_opt" => [
		"uri" => "/hello/{name?}",
		"method" => "GET",
		"action" => function($name = null) {
			return "Hello " . ($name ? $name : "there");
		}
	],
	"add" => [
		"uri" => "/add/{a}/{b}",
		"method" => "GET",
		"parameters" => [
			"a" => "[0-9]+",
			"a" => "[0-9]+"
		],
		"action" => function($name = null) {
			return "Hello " . ($name ? $name : "there");
		}
	],
	"paginate" => [
		"uri" => "/read/{page?}/{limit?}/{order_by?}",
		"method" => "GET",
		"parameters" => [
			"page" => "[0-9]+",
			"limit" => "[0-9]+",
			"order_by" => "(ASC|DESC)"
		],
		"action" => function($page = null, $limit = null, $orderBy = null) {
			return json_encode(array(
				'page' => $page,
				'limit' => $limit,
				'orderBy' => $orderBy
			));
		}
	],
];
