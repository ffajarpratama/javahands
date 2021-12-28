<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Http\Services\ProductService;
use App\Models\Product;
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

    public function index(Request $request)
    {
        $products = $this->productService->getAllProducts($request);
        $categories = $this->categoryService->getAllProducts();
        $allProductCount = $this->productService->getProductsCount();
        return view('admin.pages.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function getProductByCategory($category, Request $request)
    {
        $allProductCount = $this->productService->getProductsCount();
        $categories = $this->categoryService->getAllProducts();
        $products = $this->productService->getProductsByCategory($request, $category);
        return view('admin.pages.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllProducts();
        return view('admin.pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->productService->storeProduct($request);
        return redirect()->route('admin.products.index')->with('success', 'New product added!');
    }

    public function show(Product $product, Request $request)
    {
        $newProductName = $this->productService->processProductName($product->name)['newProductName'];
        $productLastName = $this->productService->processProductName($product->name)['productLastName'];
        $comments = $this->productService->sortComment($request, $product->id);

        return view('admin.pages.product.show', compact('product', 'productLastName', 'newProductName', 'comments'));
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->getAllProducts();
        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->productService->updateProduct($request, $product);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('admin.products.index')->with('danger', 'Product deleted!');
    }
}
