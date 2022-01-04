<?php

namespace App\Http\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategoriesPaginated(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        //ambil semua category dengan product yang ada pada category tersebut, paginasi 5 item per halaman
        return Category::query()->with('products')->latest()->paginate(5);
    }

    public function getAllCategories()
    {
        //ambil jumlah product pada category
        //category yang diambil adalah semua category atau collection of categories, bukan salah satu
        //buat tau jumlah product di salah satu category perlu di-foreach
        //biar jumlah product bisa diambil pake $category->products_count
        return Category::query()->withCount('products')->get();
    }

    public function storeCategory($request)
    {
        //save category ke database
        return Category::query()->create([
            'name' => $request->name
        ]);
    }

    public function updateCategory($request, $category)
    {
        //update category
        return $category->update([
            'name' => $request->name
        ]);
    }

    public function deleteCategory($category)
    {
        //hapus category
        return $category->delete();
    }
}
