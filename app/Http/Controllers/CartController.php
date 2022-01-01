<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = User::query()->where('id', auth()->id())->first();
        $products = Product::query()->latest()->take(2)->get();
        return view('user.cart.index', compact('user', 'products'));
    }
}
