<?php

use Epic\Database\Schema;
use Epic\Database\Table;

/*
 * 
 */

$schema = new Schema('itso');

$schema->addTable('admin_message', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('title')->length(255)->nullable(false)->comment('');
	$table->text('text')->nullable(false)->comment('Texte du message');
	$table->integer('picture_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->dateTime('updated_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('user_id')->nullable(false)->comment('Createur du message');
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
}, "Permet d'afficher des messages sur les espaces celebrites/visiteurs");

$schema->addTable('blog_article', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('title')->length(255)->nullable(false);
	$table->text('text')->nullable(false);
	$table->integer('picture_id')->nullable(false);
	$table->integer('blog_article_category_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->dateTime('updated_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('state')->nullable(false)->comment('etat');
	$table->tinyInteger('active')->nullable(false)->defaultValue('0')->comment('Actif oui/non');
}, "Article du blog");

$schema->addTable('blog_article_category', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('state')->nullable(false)->comment('etat');
	$table->tinyInteger('active')->nullable(false)->defaultValue('0')->comment('Actif oui/non');
});

$schema->addTable('brand', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('picture_id')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
}, "Marque");

$schema->addTable('celebrity_category', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('parent_id')->nullable(true);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
}, "Categorie de celebrites");

$schema->addTable('user_celebrity_category', function(Table $table) {
	$table->integer('celebrity_category_id')->nullable(false);
	$table->integer('user_id')->nullable(false);
}, "Lien entre une celebrite et une categorie");

$schema->addTable('charity_association', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('picture_id')->nullable(true);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
}, "Charity");

// @TODO
$schema->addTable('user_favorite', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(true);
	$table->integer('product_id')->nullable(false);
	$table->integer('favorite_category_id')->nullable(false);
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

// @TODO
$schema->addTable('user_favorite_category', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('user_id')->nullable(false);
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

// @NEXT
$schema->addTable('hashtag', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->integer('name')->nullable(false);
	$table->integer('product_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('state')->nullable(false);
});

$schema->addTable('liked', function(Table $table) {
	$table->integer('user_id')->nullable(false);
	$table->integer('product_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->dateTime('deleted_at')->nullable(true);
	$table->integer('state')->nullable(false)->defaultValue('0');
}, "Quand un visiteur aime un produit");

/*$schema->addTable('note', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->integer('value')->nullable(false);
	$table->integer('user_id')->nullable(false);
});*/

$schema->addTable('picture', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
});

$schema->addTable('product_category', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('sex')->nullable(true);
	$table->integer('parent_id')->nullable(true);
	$table->integer('picture_id')->nullable(true);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

$schema->addTable('product', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('brand_id')->nullable(false);
	$table->integer('main_color_id')->nullable(false);
	$table->integer('product_type_id')->nullable(false);
	$table->integer('state')->nullable(false)->defaultValue('1');
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

$schema->addTable('product_link', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('url')->length(255)->nullable(false);
	$table->integer('product_id')->nullable(false);
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

$schema->addTable('product_picture', function(Table $table) {
	$table->integer('product_id')->nullable(false);
	$table->integer('picture_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
});

$schema->addTable('product_link_click', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->integer('product_link_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
});

$schema->addTable('subscription', function(Table $table) {
	$table->integer('member_id')->nullable(false);
	$table->integer('celebrity_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
}, "Quand un visiteur suit une celebrite");

$schema->addTable('user', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('last_name')->length(255)->nullable(false);
	$table->varchar('first_name')->length(255)->nullable(false);
	$table->dateTime('day_of_birth')->nullable(true);
	$table->varchar('email')->length(255)->nullable(false);
	$table->varchar('password')->length(255)->nullable(false);
	$table->integer('gender')->nullable(false);
	$table->integer('picture_id')->nullable(true);
	$table->integer('language')->nullable(false);
	$table->integer('nationality')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->dateTime('updated_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
	$table->integer('user_type_id')->nullable(false);
	$table->integer('charity_id')->nullable(true);
});

$schema->addTable('user_type', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

$schema->addTable('donation', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->integer('user_id')->nullable(false);
	$table->float('amount')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
}, 'Don à itso');

$schema->addTable('user_product', function(Table $table) {
	$table->integer('user_id')->nullable(false);
	$table->integer('product_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
});

$schema->addTable('boutique_affiliation', function(Table $table) {
	$table->integer('id')->nullable(false);
    $table->varchar('url_site')->length(255)->nullable(false);
    $table->varchar('name')->length(255)->nullable(false);
	$table->integer('id_affiliate')->nullable(false);
	$table->float('commission_percent')->nullable(true);
    $table->varchar('periode_payement')->length(255)->nullable(false);
    $table->varchar('contact_email')->length(255)->nullable(false);
});

$schema->addTable('color', function(Table $table) {
    $table->integer('id')->primary(true);
    $table->varchar('name')->length(255)->nullable(false);
    $table->varchar('hex')->length(255)->nullable(false);
});

$schema->addTable('publication', function(Table $table) {
    $table->integer('id')->primary(true);
    $table->varchar('title')->length(255)->nullable(false);
	$table->text('description')->nullable(false);
    $table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
});

$schema->addTable('selection', function(Table $table) {
    $table->integer('id')->primary(true);
    $table->varchar('label')->length(255)->nullable(false);
    $table->varchar('target')->length(8)->nullable(false);
    $table->varchar('type')->length(32)->nullable(false);
	$table->integer('state')->nullable(false);
	$table->tinyInteger('active')->nullable(false)->defaultValue('0');
}, "Selection de produit/celebrite");

$schema->addTable('selection_product', function(Table $table) {
	$table->integer('selection_id')->nullable(false);
	$table->integer('product_id')->nullable(false);
});

$schema->addTable('selection_user', function(Table $table) {
	$table->integer('selection_id')->nullable(false);
	$table->integer('user_id')->nullable(false);
});

$schema->addTable('wishlist', function(Table $table) {
	$table->integer('id')->primary(true);
	$table->varchar('name')->length(255)->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
	$table->integer('user_id')->nullable(false);

});

$schema->addTable('product_wishlist', function(Table $table) {
    $table->integer('product_id')->nullable(false);
    $table->integer('wishlist_id')->nullable(false);
	$table->dateTime('created_at')->nullable(false)->defaultValue('CURRENT_TIMESTAMP');
});

return $schema;
