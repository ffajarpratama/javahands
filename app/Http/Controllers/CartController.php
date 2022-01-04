<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //method untuk tampilin semua cart punya user
    public function index()
    {
        //url: /user/cart
        //cari user di database berdasarkan id user yang login
        $user = User::query()
            ->where('id', auth()->id())
            ->first();

        //ambil carts dari user
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', $user->id)
            ->where('order_id', null)
            ->get();

        //render view /views/user/cart/index
        return view('user.cart.index', compact('user', 'carts'));
    }

    public function store(Product $product, User $user)
    {
        //cari apakah cart dengan product_id dan user_id yang sama sudah ada
        $selectedProduct = Cart::query()
            ->where('product_id', $product->id)
            ->where('user_id', $user->id)
            //cari yang order_id nya masih kosong/null (belum diorder/checkout)
            ->where('order_id', null)
            ->first();

        //kalo ada data cart dengan product_id dan user_id yang sama
        if ($selectedProduct) {
            //naikin jumlah quantitynya
            $newQuantity = $selectedProduct->quantity + 1;
            //update kolom sub_total di table carts, harga satuan product * jumlah product yang ada di cart
            $newSubTotal = $selectedProduct->unit_price * $newQuantity;
            //update product
            $selectedProduct->update([
                'quantity' => $newQuantity,
                'sub_total' => $newSubTotal
            ]);

            //kalo product yang ditambahin ke cart sebelumnya belum dipilih user
        } else {
            //harga satuan product = harga product
            $productPrice = $product->price;
            //set quantity cart = 1
            $quantity = 1;

            //kalo product ada diskonnya
            if ($product->discount) {
                //hitung harga product setelah diskon
                $productDiscountedPrice = $product->price - ($product->price * ($product->discount / 100));
                //set harga satuan product dengan harga diskon
                $productPrice = (int)ceil($productDiscountedPrice);
            }

            //set kolom sub_total di table carts, harga satuan product * jumlah product
            $subTotal = $productPrice * $quantity;

            //save cart ke database
            Cart::query()->create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'unit_price' => $productPrice,
                'quantity' => $quantity,
                'sub_total' => $subTotal
            ]);
        }

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
