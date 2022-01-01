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

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->productService->storeProduct($request);
        return redirect()->back()->with('success', 'New product added!');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->productService->updateProduct($request, $product);
        return redirect()->route('products.index', ['category' => 'all_products'])->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('products.index', ['category' => 'all_products'])->with('danger', 'Product deleted!');
    }
}
