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
    $trail->push('Products', route('products.home'));
});

//PRODUCT CATEGORIES
Breadcrumbs::for('product-categories', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('Product Categories', route('user.products.index'));
});
