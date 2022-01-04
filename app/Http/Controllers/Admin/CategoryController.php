<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;


    //dependency injection biar category service bisa dipakai
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    //method untuk ambil semua category
    public function index()
    {
        //url: /admin/categories
        //ambil semua category pakai category service
        $categories = $this->categoryService->getAllCategoriesPaginated();

        //render view: /views/admin/categories/index dengan variable categories
        return view('admin.category.index', compact('categories'));
    }

    //method untuk render halaman tambah category
    public function create()
    {
        //url: /admin/categories/create
        //render view: /views/admin/categories/create
        return view('admin.category.create');
    }

    //method buat save category ke database
    public function store(Request $request)
    {
        //save category ke database pake method storeCategory di category service dengan parameter request object
        $this->categoryService->storeCategory($request);

        //redirect ke url: /admin/categories dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'New category added!');
    }

    //method buat render halaman edit category
    public function edit(Category $category)
    {
        //url: /admin/categories/edit/{id category}
        //render view: /views/admin/categories/edit dengan variable category
        return view('admin.category.edit', compact('category'));
    }

    //method buat update category
    public function update(Request $request, Category $category)
    {
        //url: /admin/categories/update/{id category}
        //update category pake method updateCategory di category service dengan parameter request object dan category yang dipilih
        $this->categoryService->updateCategory($request, $category);

        //redirect ke url: /admin/categories dengan pesan sukses
        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    //method buat hapus category
    public function destroy(Category $category)
    {
        //url: /admin/categories/delete/{id category}
        //hapus category pake method deleteCategory di category service dengan parameter category yang dipilih
        $this->categoryService->deleteCategory($category);

        //redirect ke url: /admin/categories dengan pesan peringatan
        return redirect()->route('admin.categories.index')->with('danger', 'Category deleted!');
    }
}
