<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', $user->id)
            ->get();
        return view('user.cart.index', compact('user', 'carts'));
    }

    public function store(Product $product, User $user)
    {
        $selectedProduct = Cart::query()
            ->where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->first();

        if ($selectedProduct) {
            $newQuantity = $selectedProduct->quantity + 1;
            $newSubTotal = $selectedProduct->unit_price * $newQuantity;
            $selectedProduct->update([
                'quantity' => $newQuantity,
                'sub_total' => $newSubTotal
            ]);
        } else {
            $productPrice = $product->price;
            $quantity = 1;

            if ($product->discount) {
                $productDiscountedPrice = $product->price - ($product->price * ($product->discount / 100));
                $productPrice = (int)ceil($productDiscountedPrice);
            }

            $subTotal = $productPrice * $quantity;

            Cart::query()->create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'unit_price' => $productPrice,
                'quantity' => $quantity,
                'sub_total' => $subTotal
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
