<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;

class ProductService
{
    public function getProductsCount(): int
    {
        return Product::all()->count();
    }

    private function sortProductByDate($category): \Illuminate\Contracts\Pagination\LengthAwarePaginator
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

    private function sortProductByPrice($category): \Illuminate\Contracts\Pagination\LengthAwarePaginator
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

    private function sortProductByRating($category): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        if ($category == 'all_products') {
            return Product::query()
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->join('categories', 'categories.id', '=', 'category_product.category_id')
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

    public function getAllProducts($request): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $sortBy = $request->query('sortBy');
        $category = $request->query('category');

        if (is_null($sortBy) || $sortBy == 'newest') {
            $products = $this->sortProductByDate($category);
        } else if ($sortBy == 'price') {
            $products = $this->sortProductByPrice($category);
        } else if ($sortBy == 'rating') {
            $products = $this->sortProductByRating($category);
        }

        return $products;
    }

    public function storeProduct($request)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'description' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $imageExt = $request->file('picture')->getClientOriginalExtension();
        $imageName = $this->processName($request->name, $imageExt);
        $request->file('picture')->move(public_path('products'), $imageName);

        $product = Product::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => (int)$request->discount,
            'description' => $request->description,
            'picture' => $imageName,
        ]);
        return $product->categories()->attach($request->categories);
    }

    private function processName($string, $ext): string
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return $string . '.' . $ext;
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

    public function updateProduct($request, $product)
    {
        $productPictureName = $product->picture;
        $filePath = public_path('products/' . $product->picture);

        if ($request->file('picture')) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $imageExt = $request->file('picture')->getClientOriginalExtension();
            $productPictureName = $this->processName($request->name, $imageExt);
            $request->file('picture')->move(public_path('products'), $productPictureName);
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => (int)$request->discount,
            'description' => $request->description,
            'picture' => $productPictureName,
        ]);

        return $product->categories()->sync($request->categories);
    }

    public function deleteProduct($product)
    {
        $filePath = public_path('products/' . $product->picture);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        return $product->delete();
    }
}
