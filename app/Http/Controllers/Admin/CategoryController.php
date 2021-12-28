<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllProductsPaginated();
        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request);
        return redirect()->route('admin.categories.index')->with('success', 'New category added!');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->categoryService->updateCategory($request, $category);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('admin.categories.index')->with('danger', 'Category deleted!');
    }
}
