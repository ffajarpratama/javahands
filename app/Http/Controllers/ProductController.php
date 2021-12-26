<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->with(['categories', 'comments.likes', 'comments.dislikes'])->get();
        $categories = Category::all();
        $allProductCount = $products->count();
        $users = User::query()->with('comments')->get();

//        count how many comments of a user
//        dd($users[1]->comments->count());

//        get product count of a category
//        dd($categories[0]->products->count());

//        get a product of a category
//        dd($categories[0]->products[0]->name);

//        count how many users commented on this product
//        dd($products[0]->comments->count());

//        count average rating of the product
//        dd($products[0]->comments->average('rating'));

//        get categories of a product
//        dd($products[0]->categories);

//        get a category of a product
//        dd($products[0]->categories[0]->name);
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function getProductByCategory($category)
    {
        $allProductCount = Product::all()->count();
        $category = Category::query()
            ->where('name', $category)
            ->with('products')
            ->first();
        $products = $category->products;
        $categories = Category::all();
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
