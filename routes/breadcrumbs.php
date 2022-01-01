<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//HOME
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

//PRODUCTS
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Products', route('product.home'));
});

//PRODUCT CATEGORIES
Breadcrumbs::for('product-categories', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Product Categories', route('product.index', ['category' => 'all_products']));
});

//PRODUCT DETAILS
Breadcrumbs::for('product-details', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('product-categories');
    $trail->push('Product Details', route('product.show', $product->id));
});

//CART
Breadcrumbs::for('cart', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cart', route('user.cart.index'));
});
