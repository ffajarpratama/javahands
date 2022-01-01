<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategoriesPaginated(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Category::query()->with('products')->latest()->paginate(5);
    }

    public function getAllCategories()
    {
        return Category::query()->withCount('products')->get();
    }

    public function storeCategory($request)
    {
        return Category::query()->create([
            'name' => $request->name
        ]);
    }

    public function updateCategory($request, $category)
    {
        return $category->update([
            'name' => $request->name
        ]);
    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }
}
