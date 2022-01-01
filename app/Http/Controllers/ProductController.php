<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function home()
    {
        $products = Product::query()->latest()->take(4)->get();
        return view('user.product.home', compact('products'));
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAllProducts($request);
        $categories = $this->categoryService->getAllCategories();
        $allProductCount = $this->productService->getProductsCount();
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function show(Product $product, Request $request)
    {
        $product = $product->loadCount('comments');
        $newProductName = $this->productService->processProductName($product->name)['newProductName'];
        $productLastName = $this->productService->processProductName($product->name)['productLastName'];
        $comments = $this->productService->sortComment($request, $product->id);
        return view('user.product.show', compact('product', 'newProductName', 'productLastName', 'comments'));
    }

    public function search(Request $request)
    {
        $products = Product::query()
            ->where('name', 'LIKE', "%{$request->search_value}%")
            ->latest()
            ->paginate(15);
        $categories = $this->categoryService->getAllCategories();
        $allProductCount = $this->productService->getProductsCount();
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }
}
