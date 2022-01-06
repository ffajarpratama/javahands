<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Description;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Salmanbe\FileName\FileName;

class ProductService
{
    //product service
    //isinya logic-logic buat ngambil data dari database
    //kenapa pake service class? supaya controller lebih gampang dibaca
    public function getProductsCount(): int
    {
        return Product::all()->count();
    }

    //sort product berdasarkan tanggal, parameter = nama category
    private function sortProductByDate($category): LengthAwarePaginator
    {
        //kalo url parameter dengan nama category dan isinya all_products ada di url /product
        //contoh: /product?category=all_products
        //paginasi/batasin data yang ditampilin di pagenya cuma 15
        //latest() = urutin berdasarkan data yang paling baru dibuat
        if ($category == 'all_products') {
            return Product::query()
                ->latest()
                ->paginate(15);
        }

        //kalo isi dari category di url parameter bukan all_products
        //contoh: /product?category=Accessories
        //ngambil 1 data category dimana namanya = nama category di url parameter
        $category = Category::query()
            ->where('name', $category)
            ->with('products')
            ->first();

        //kalo isi dari category di url parameter bukan all_products atau nama category di table category
        //tampilin halaman 404
        if (!$category) {
            abort(404);
        }

        //return semua product yang ada di category itu, sort by date, terus dipaginasi sebanyak 15 data/halaman
        return $category->products()->latest()->paginate(15);
    }

    //sort product berdasarkan harga, parameter = nama category
    private function sortProductByPrice($category): LengthAwarePaginator
    {
        //kalo url parameter dengan nama category dan isinya all_products ada di url /product
        //contoh: /product?category=all_products
        //paginasi/batasin data yang ditampilin di pagenya cuma 15
        //urutin berdasarkan harga terendah
        if ($category == 'all_products') {
            return Product::query()
                ->orderBy('price', 'ASC')
                ->paginate(15);
        }

        //kalo isi dari category di url parameter bukan all_products
        //contoh: /product?category=Accessories
        //ngambil 1 data category dimana namanya = nama category di url parameter
        $category = Category::query()
            ->where('name', $category)
            ->with('products')
            ->first();

        //return semua product yang ada di category itu, sort by price, terus dipaginasi sebanyak 15 data/halaman
        return $category->products()->orderBy('price', 'ASC')->paginate(15);
    }

    //sort product berdasarkan rating, parameter = nama category
    private function sortProductByRating($category): LengthAwarePaginator
    {
        //kalo url parameter dengan nama category dan isinya all_products ada di url /product
        //contoh: /product?category=all_products
        //paginasi/batasin data yang ditampilin di pagenya cuma 15
        //urutin berdasarkan rating tertinggi
        //with('comments') berarti dia ngambil semua produk sama semua comment di tiap produknya, cek model Product
        //withAvg = hitung rata-rata rating dari semua komen yang ada di tiap produk
        if ($category == 'all_products') {
            return Product::query()->with('comments')
                ->withAvg('comments', 'rating')
                ->orderBy('comments_avg_rating', 'DESC')
                ->paginate(15);
        }

        //kalo isi dari category di url parameter bukan all_products
        //contoh: /product?category=Accessories
        //ambil product, terus di-join sama category_product, terus di-join lagi sama categories
        //product sama category = many to many, ada product_id sama category_id di table category_product
        //product di-join sama category biar bisa ngambil semua product yang ada di category tersebut
        //withAvg = hitung rata-rata rating dari semua komen yang ada di tiap produk
        return Product::query()
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'categories.id', '=', 'category_product.category_id')
            ->where('categories.name', '=', $category)
            ->withAvg('comments', 'rating')
            ->orderBy('comments_avg_rating', 'DESC')
            ->paginate(15);
    }

    //method buat ngambil semua product
    public function getAllProducts($request): LengthAwarePaginator
    {
        //ambil url parameter category sama sortBy dari url /product
        $sortBy = $request->query('sortBy');
        $category = $request->query('category');
        //isi variabel products dengan product terbaru semisal kondisi di bawah ga ada yang terpenuhi
        $products = Product::query()->latest()->paginate(15);

        //cek apa url parameter dengan nama category ada di url
        if ($category) {
            //kalo url parameter dengan nama sortBy is not null ATAU isi dari sortBy = newest
            if (is_null($sortBy) || $sortBy == 'newest') {
                //urutin berdasarkan tanggal
                $products =  $this->sortProductByDate($category);
            }

            //kalo sortBy = price
            if ($sortBy == 'price') {
                //urutin berdasarkan harga terendah
                $products =  $this->sortProductByPrice($category);
            }

            //kalo sortBy = rating
            if ($sortBy == 'rating') {
                //urutin berdasarkan rating tertinggi
                $products =  $this->sortProductByRating($category);
            }
        }

        //kalo kondisi di atas gada yang terpenuhi, return product terbaru
        return $products;
    }

    //method buat tambah product buat admin
    public function storeProduct($request)
    {
        //validasi
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'picture' => ['required', 'image', 'max:2048'],
            'material' => ['required'],
            'measurement' => ['required'],
            'description' => ['required'],
            'additional_note' => ['required']
        ]);

        //bikin nama file baru buat gambar product
        //ambil extension gambar
        $imageExt = $request->file('picture')->getClientOriginalExtension();
        //nama gambar = nama product yang diinput + extension
        $imageName = $request->name . '.' . $imageExt;
        //buat bikin nama file, make package FileName
        $imageName = FileName::get($imageName, ['timestamp' => 'Y-m-d']);
        //save gambar di folder public/storage/products
        $request->file('picture')->storeAs('products', $imageName, 'public');

        //save product ke database
        $product = Product::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'discount' => (int)$request->discount,
            'picture' => $imageName,
        ]);

        //save description product juga ke database
        Description::query()->create([
            'product_id' => $product->id,
            'material' => $request->material,
            'measurement' => $request->measurement,
            'description' => $request->description,
            'additional_note' => $request->additional_note
        ]);
        //karena product sama category many to many, pas tambah product dia juga ngisi table category_product
        //karena di form tambah product, ada field buat nambahin product ini kategorinya apa aja
        //->attach($request->categories) itu buat ngisi table category_product (product ini masuk ke category apa aja)
        return $product->categories()->attach($request->categories);
    }

    //update product (admin)
    public function updateProduct($request, $product)
    {
        //validasi
        $request->validate([
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'picture' => ['max:2048'],
            'material' => ['required'],
            'measurement' => ['required'],
            'description' => ['required'],
            'additional_note' => ['required']
        ]);

        //set variable yang isinya nama gambar product
        $newPictureName = $product->picture;

        //cek kalo pas update product ada gambar yang dipilih
        if ($request->file('picture')) {
            //bikin nama file baru buat gambar product
            //ambil extension gambar
            $imageExt = $request->file('picture')->getClientOriginalExtension();
            //nama gambar = nama product yang diinput + extension
            $newPictureName = $request->name . '.' . $imageExt;
            //cek kalo product udah punya gambar sendiri (bukan placeholder)
            if ($product->picture) {
                //hapus gambar
                Storage::disk('public')->delete('products/' . $product->picture);
            }
            //update isi variable dengan nama file baru
            $newPictureName = FileName::get($newPictureName, ['timestamp' => 'Y-m-d']);
            //save gambar di folder public/storage/products
            $request->file('picture')->storeAs('products', $newPictureName, 'public');
        }

        //update product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'discount' => (int)$request->discount,
            'picture' => $newPictureName,
        ]);
        //update table category_product, apakah ada kategori yang ditambah atau dihapus di product tersebut
        return $product->categories()->sync($request->categories);
    }

    //hapus product
    public function deleteProduct($product)
    {
        //cek kalo product punya gambar (bukan placeholder)
        if ($product->picture) {
            //kalo ada, hapus gambar
            Storage::disk('public')->delete('products/' . $product->picture);
        }
        //hapus product
        return $product->delete();
    }

    //method buat nampilin nama product di halaman product details
    //nama product perlu diproses dulu karena di halaman product details, string terakhir dari nama product dibikin bold
    //nama terakhir product bakal ditampilin tanpa ada sepcial characters apapun
    public function processProductName($string): array
    {
        //hapus semua special characters dari nama product kecuali spasi
        $sanitizeName = trim(preg_replace('/[^a-zA-Z]+/', ' ', $string));
        //ubah nama product jadi array
        $tempArray = explode(' ', $sanitizeName);
        //ambil nama terakhir product pake array_pop karena nama product bentuknya udah jadi array
        $productLastName = array_pop($tempArray);
        //bikin variable buat nama product baru (nama produk tanpa nama terakhir yang udah di array_pop sebelumnya
        //buat ilangin nama product terakhir, pake str_replace, dimana nama product terakhir bakal diganti sama '' atau string kosong
        $newProductName = str_replace($productLastName, '', $sanitizeName);

        //return 2 variable, nama product baru (tanpa nama terakhir) dan nama terakhir product
        return ['newProductName' => $newProductName, 'productLastName' => $productLastName];
    }

    //method buat sort comment
    public function sortComment($request, $product_id)
    {
        //cek kalo di url /product/{id product} ada url parameter
        //contoh /product/1?sortComment=popular
        //simpan url parameter di variable column
        $column = $request->query('sortCommentBy');

        //kalo sortComment = popular
        if ($column == 'popular') {
            //ganti isi variable column yang sebelumnya popular jadi likes_count
            //isi variable diubah karena semua komen bakal diload dengan withCount
            //berdasarkan dokumentasi laravel eloquent, kalo model diload dengan withCount, kolom {nama table}_count otomatis dibuat
            //isi dari kolom itu = jumlah data yang berhubungan dengan table sebelumnya
            //table comments berhubungan sama table likes (one to many), yang berarti ada comment_id di table likes
            //data yang ditampilkan nanti adalah semua comment diurutkan berdasarkan jumlah likenya
            $column = 'likes_count';
            $comments = Comment::query()
                ->where('product_id', $product_id)
                ->with(['likes', 'dislikes', 'reply'])
                ->withCount('likes')
                ->orderBy($column, 'DESC')
                ->get();

            //kalo sortComment = rating, langsung diurutin berdasarkan kolom rating yang ada di table comments
        } else if ($column == 'rating') {
            $column = 'rating';
            $comments = Comment::query()
                ->with(['likes', 'dislikes', 'reply'])
                ->where('product_id', $product_id)
                ->orderBy($column, 'DESC')
                ->get();
        } else {
            //kalo kondisi kondisi di atas ga terpenuhi, data yang ditampilkan adalah comment yang diurutkan berdasarkan tanggal
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
