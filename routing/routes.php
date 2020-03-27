<?php

return [
	"home" => [
		"uri" => "/",
		"action" => function() {
			return "In The Showes Of";
		}
	],
	"hello" => [
		"uri" => "/hello/{name}",
		"action" => function($name) {
			return "Hello $name";
		}
	],
	"hello_opt" => [
		"uri" => "/hello/{name?}",
		"action" => function($name = null) {
			return "Hello ".($name ? $name : "there");
		}
	],
	"add" => [
		"uri" => "/add/{a}/{b}",
		"parameters" => [
			"a" => "[0-9]+",
			"a" => "[0-9]+"
		],
		"action" => function($name = null) {
			return "Hello ".($name ? $name : "there");
		}
	],
	"paginate" => [
		"uri" => "/read/{page?}/{limit?}/{order_by?}",
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
