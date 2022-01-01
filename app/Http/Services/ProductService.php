<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Description;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Salmanbe\FileName\FileName;

class ProductService
{
    public function getProductsCount(): int
    {
        return Product::all()->count();
    }

    private function sortProductByDate($category): LengthAwarePaginator
    {
        if ($category == 'all_products') {
            return Product::query()
                ->latest()
                ->paginate(15);
        }

        $category = Category::query()
            ->where('name', $category)
            ->with('products')
            ->first();

        return $category->products()->latest()->paginate(15);
    }

    private function sortProductByPrice($category): LengthAwarePaginator
    {
        if ($category == 'all_products') {
            return Product::query()
                ->orderBy('price', 'ASC')
                ->paginate(15);
        }

        $category = Category::query()
            ->where('name', $category)
            ->with('products')
            ->first();

        return $category->products()->orderBy('price', 'ASC')->paginate(15);
    }

    private function sortProductByRating($category): LengthAwarePaginator
    {
        if ($category == 'all_products') {
            return Product::query()->with('comments')
                ->withAvg('comments', 'rating')
                ->orderBy('comments_avg_rating', 'DESC')
                ->paginate(15);
        }

        return Product::query()
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->where('categories.name', '=', $category)
            ->withAvg('comments', 'rating')
            ->orderBy('comments_avg_rating', 'DESC')
            ->paginate(15);
    }

    public function getAllProducts($request): LengthAwarePaginator
    {
        $sortBy = $request->query('sortBy');
        $category = $request->query('category');

        if (!$category || !$sortBy) {
            return Product::query()->latest()->paginate(15);
        }

        if ($sortBy == 'newest') {
            return $this->sortProductByDate($category);
        }

        if ($sortBy == 'price') {
            return $this->sortProductByPrice($category);
        }

        if ($sortBy == 'rating') {
            return $this->sortProductByRating($category);
        }

        return Product::query()->latest()->paginate(15);
    }

    public function storeProduct($request)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'picture' => ['required', 'image', 'max:2048'],
            'material' => ['required'],
            'measurement' => ['required'],
            'description' => ['required'],
            'additional_note' => ['required']
        ]);

        $imageExt = $request->file('picture')->getClientOriginalExtension();
        $imageName = $request->name . '.' . $imageExt;
        $imageName = FileName::get($imageName, ['timestamp' => 'Y-m-d']);
        $request->file('picture')->storeAs('products', $imageName, 'public');

        $product = Product::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => (int)$request->discount,
            'picture' => $imageName,
        ]);

        Description::query()->create([
            'product_id' => $product->id,
            'material' => $request->material,
            'measurement' => $request->measurement,
            'description' => $request->description,
            'additional_note' => $request->additional_note
        ]);
        return $product->categories()->attach($request->categories);
    }

    public function updateProduct($request, $product)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'picture' => ['max:2048'],
            'material' => ['required'],
            'measurement' => ['required'],
            'description' => ['required'],
            'additional_note' => ['required']
        ]);

        $newPictureName = $product->picture;

        if ($request->file('picture')) {
            $imageExt = $request->file('picture')->getClientOriginalExtension();
            $newPictureName = $request->name . '.' . $imageExt;
            if ($product->picture) {
                Storage::disk('public')->delete('products/' . $product->picture);
            }
            $newPictureName = FileName::get($newPictureName, ['timestamp' => 'Y-m-d']);
            $request->file('picture')->storeAs('products', $newPictureName, 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => (int)$request->discount,
            'picture' => $newPictureName,
        ]);
        return $product->categories()->sync($request->categories);
    }

    public function deleteProduct($product)
    {
        if ($product->picture) {
            Storage::disk('public')->delete('products/' . $product->picture);
        }
        return $product->delete();
    }

    public function processProductName($string): array
    {
        $sanitizeName = trim(preg_replace('/[^a-zA-Z]+/', ' ', $string));
        $tempArray = explode(' ', $sanitizeName);
        $productLastName = array_pop($tempArray);
        $newProductName = str_replace($productLastName, '', $sanitizeName);

        return ['newProductName' => $newProductName, 'productLastName' => $productLastName];
    }

    public function sortComment($request, $product_id)
    {
        $column = $request->query('sortCommentBy');

        if ($column == 'popular') {
            $column = 'likes_count';
            $comments = Comment::query()
                ->where('product_id', $product_id)
                ->with(['likes', 'dislikes', 'reply'])
                ->withCount('likes')
                ->orderBy($column, 'DESC')
                ->get();
        } else if ($column == 'rating') {
            $column = 'rating';
            $comments = Comment::query()
                ->with(['likes', 'dislikes', 'reply'])
                ->where('product_id', $product_id)
                ->orderBy($column, 'DESC')
                ->get();
        } else {
            $column = 'created_at';
            $comments = Comment::query()
                ->with(['likes', 'dislikes', 'reply'])
                ->where('product_id', $product_id)
                ->orderBy($column, 'DESC')
                ->get();
        }

        return $comments;
    }
}
