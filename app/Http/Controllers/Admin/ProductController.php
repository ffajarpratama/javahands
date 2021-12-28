<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $column = $request->query('sortBy');

        if ($column == 'rating') {
            $products = Product::query()
                ->withAvg('comments', 'rating')
                ->orderBy('comments_avg_rating', 'DESC')
                ->paginate(15);
        } else if ($column == 'price') {
            $column = 'price';
            $products = Product::query()
                ->orderBy($column, 'ASC')
                ->paginate(15);
        } else {
            $column = 'created_at';
            $products = Product::query()
                ->orderBy($column, 'DESC')
                ->paginate(15);
        }

        $categories = Category::all();
        $allProductCount = Product::all()->count();
        return view('admin.pages.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function getProductByCategory($category, Request $request)
    {
        $allProductCount = Product::all()->count();
        $categories = Category::all();

        $sortBy = $request->query('sortBy');
        if (is_null($sortBy)) {
            $sortBy = 'id';
        }

        if ($sortBy != 'rating') {
            if ($sortBy == 'newest') {
                $sortBy = 'created_at';
            } else if ($sortBy == 'price') {
                $sortBy = 'price';
            }

            $products = Product::query()
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->join('categories', 'categories.id', '=', 'category_product.category_id')
                ->where('categories.name', '=', $category)
                ->orderBy('products.' . $sortBy, 'ASC')
                ->paginate(15);
        } else {
            $products = Product::query()
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->join('categories', 'categories.id', '=', 'category_product.category_id')
                ->where('categories.name', '=', $category)
                ->withAvg('comments', 'rating')
                ->orderBy('comments_avg_rating', 'DESC')
                ->paginate(15);
        }

        return view('admin.pages.product.index', compact('products', 'categories', 'allProductCount'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.product.create', compact('categories'));
    }

    public function store(Request $request)
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
        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products.index')->with('success', 'New product added!');
    }

    private function processName($string, $ext)
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        return $string . '.' . $ext;
    }

    public function show(Product $product, Request $request)
    {
        $newProductName = $this->processProductName($product->name)['newProductName'];
        $productLastName = $this->processProductName($product->name)['productLastName'];
        $column = $request->query('sortCommentBy');
        $comments = $this->sortComment($column, $product->id);

        return view('admin.pages.product.show', compact('product', 'productLastName', 'newProductName', 'comments'));
    }

    private function sortComment($column, $product_id)
    {
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

    private function processProductName($string)
    {
        $sanitizeName = trim(preg_replace('/[^a-zA-Z]+/', ' ', $string));
        $tempArray = explode(' ', $sanitizeName);
        $productLastName = array_pop($tempArray);
        $newProductName = str_replace($productLastName, '', $sanitizeName);

        return ['newProductName' => $newProductName, 'productLastName' => $productLastName];
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
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
        $product->categories()->sync($request->categories);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $filePath = public_path('products/' . $product->picture);
        unlink($filePath);
        $product->delete();

        return redirect()->route('admin.products.index')->with('danger', 'Product deleted!');
    }
}
