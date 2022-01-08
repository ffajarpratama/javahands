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
            //update kolom total_weight di table carts, weight product * jumlah product yang ada di cart
            $newTotalWeight = $selectedProduct->unit_weight * $newQuantity;
            //update product
            $selectedProduct->update([
                'quantity' => $newQuantity,
                'total_weight' => $newTotalWeight,
                'sub_total' => $newSubTotal
            ]);

            //kalo product yang ditambahin ke cart sebelumnya belum dipilih user
        } else {
            //harga satuan product = harga product
            $productPrice = $product->price;
            //berat satuan product = berat product
            $productWeight = $product->weight;
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
            //set kolom total_weight di table carts, berat satuan product * jumlah product
            $totalWeight = $productWeight * $quantity;

            //save cart ke database
            Cart::query()->create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'unit_price' => $productPrice,
                'unit_weight' => $productWeight,
                'quantity' => $quantity,
                'total_weight' => $totalWeight,
                'sub_total' => $subTotal
            ]);
        }

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function updateQuantity(Cart $cart)
    {
        //ambil unit price dari cart
        $unit_price = $cart->unit_price;
        //ambil unit weight dari cart
        $unit_weight = $cart->unit_weight;
        //ambil quantity dari cart
        $quantity = $cart->quantity;

        //quantity + 1
        $quantity++;
        //sub total cart  = unit price dikali quantity
        $sub_total = $unit_price * $quantity;
        //total weight cart = unit weight dikali quantity
        $total_weight = $unit_weight * $quantity;

        //update cart
        $cart->update([
            'quantity' => $quantity,
            'total_weight' => $total_weight,
            'sub_total' => $sub_total
        ]);

        //ambil semua cart dimana user id = id user yang login dan order_id = null/belum dicheckout
        $carts = Cart::query()
            ->where('user_id', auth()->id())
            ->where('order_id', null)
            ->get();

        //jumlahkan total weight dari semua cart yang didapat
        $total_weight = $carts->sum('total_weight');
        //jumlahkan sub_total dari semua cart yang didapat
        $total_price = $carts->sum('sub_total');

        //return cart, jumlah total_weight, dan total_price dalam bentuk array
        return response()->json([
            'cart' => $cart,
            'total_weight' => $total_weight,
            'total_price' => $total_price
        ]);
    }

    public function removeQuantity(Cart $cart)
    {
        //ambil unit price dari cart
        $unit_price = $cart->unit_price;
        //ambil unit weight dari cart
        $unit_weight = $cart->unit_weight;
        //ambil quantity dari cart
        $quantity = $cart->quantity;
        //ambil total_weight dari cart
        $total_weight = $cart->total_weight;
        //ambil sub_total cart
        $sub_total = $cart->sub_total;

        //quantity -1
        $quantity--;
        //sub_total = sub_total cart dikurangi unit_price
        $sub_total = $sub_total - $unit_price;
        //total_weight = total_weight cart dikurangi unit_weight
        $total_weight = $total_weight - $unit_weight;

        //jika quantity = 0
        if ($quantity < 1) {
            //hapus cart
            $cart->delete();
            //ubah variable cart menjadi variable kosong
            $cart = null;
        } else {
            //update cart
            $cart->update([
                'quantity' => $quantity,
                'total_weight' => $total_weight,
                'sub_total' => $sub_total
            ]);
        }

        //ambil semua cart dimana user id = id user yang login dan order_id = null/belum dicheckout
        $carts = Cart::query()
            ->where('user_id', auth()->id())
            ->where('order_id', null)
            ->get();

        //jumlahkan total weight dari semua cart yang didapat
        $total_weight = $carts->sum('total_weight');
        //jumlahkan sub_total dari semua cart yang didapat
        $total_price = $carts->sum('sub_total');

        //return cart, jumlah total_weight, dan total_price dalam bentuk array
        return response()->json([
            'cart' => $cart,
            'total_weight' => $total_weight,
            'total_price' => $total_price
        ]);
    }

    public function delete(Cart $cart)
    {
        //delete cart
        return $cart->delete();
    }
}
