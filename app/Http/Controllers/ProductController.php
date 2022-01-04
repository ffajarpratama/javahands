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

    //dependency injection supaya product sama category service bisa dipakai
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function home()
    {
        //url: /product/home (yang isinya featured product)
        //ngambil 4 product berdasarkan tanggal dibuat
        $products = Product::query()->latest()->take(4)->get();
        //ngerender view /views/user/product/home.blade.php
        return view('user.product.home', compact('products'));
    }

    public function index(Request $request)
    {
        //url: /product (isinya semua product)
        //url bisa pake url parameter atau ngga, contoh: /product?category=all_products?sortBy=price
        //kalo urlnya ga pake url parameter, dia nampilin semua produk berdasarkan tanggal
        $products = $this->productService->getAllProducts($request);
        $categories = $this->categoryService->getAllCategories();
        $allProductCount = $this->productService->getProductsCount();
        //ngerender view /views/user/product/index.blade.php
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function show(Product $product, Request $request)
    {
        //url: /product/{id product}
        //pake loadCount biar nanti buat ngitung comment yang ada di product ga perlu pake product->comments->count()
        $product = $product->loadCount('comments');
        //nama product baru tanpa nama terakhir yang diproses di product service
        $newProductName = $this->productService->processProductName($product->name)['newProductName'];
        //nama terakhir product yang diproses di product service
        $productLastName = $this->productService->processProductName($product->name)['productLastName'];
        //sort comment
        $comments = $this->productService->sortComment($request, $product->id);
        //render view /views/user/product/show
        return view('user.product.show', compact('product', 'newProductName', 'productLastName', 'comments'));
    }


    public function search(Request $request)
    {
        //url: /product/search?search_value
        //cari semua produk yang namanya ada karakter di search_value
        //contoh: search_value = a, cari semua produk yang ada huruf a di namanya
        $products = Product::query()
            ->where('name', 'LIKE', "%{$request->search_value}%")
            ->latest()
            ->paginate(15);
        //ambil semua category, ngambilnya pake method getAllCategories() dari category service
        $categories = $this->categoryService->getAllCategories();
        //ambil jumlah semua produk yang ada di database
        $allProductCount = $this->productService->getProductsCount();
        //render view /views/user/product/index
        return view('user.product.index', compact('products', 'categories', 'allProductCount'));
    }
}
