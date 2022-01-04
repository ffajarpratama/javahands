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

    //dependency injection biar product sama category service bisa dipakai
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    //method buat render halaman tambah product
    public function create()
    {
        //url: /admin/product/create
        //ambil semua category pake method getAllCategories di category service
        $categories = $this->categoryService->getAllCategories();

        //render view: /views/admin/product/create dengan variable categories
        return view('admin.product.create', compact('categories'));
    }

    //method buat save product ke database
    public function store(Request $request)
    {
        //save product ke database pake method storeProduct di product service dengan parameter request object
        $this->productService->storeProduct($request);

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'New product added!');
    }

    //method buat render halaman edit product
    public function edit(Product $product)
    {
        //url: /admin/product/edit/{id product yang dipilih}
        //ambil semua category pake category service
        $categories = $this->categoryService->getAllCategories();

        //render view: /admin/product/edit dengan variable product dan categories
        return view('admin.product.edit', compact('product', 'categories'));
    }


    //method buat update product
    public function update(Request $request, Product $product)
    {
        //update product pake product service dengan parameter request object dan product yang dipilih
        $this->productService->updateProduct($request, $product);

        //redirect ke url: /product dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Product updated!');
    }

    //method buat hapus product
    public function destroy(Product $product)
    {
        //hapus product pake product service dengan parameter product yang dipilih
        $this->productService->deleteProduct($product);

        //redirect ke url: /product/ dengan pesan peringatan
        return redirect()->route('product.index')->with('danger', 'Product deleted!');
    }
}
