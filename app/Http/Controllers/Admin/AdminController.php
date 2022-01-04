<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::query()
            ->with(['carts', 'carts.product', 'carts.user'])
            ->latest()
            ->get();
        return view('admin.dashboard', compact('orders'));
    }
}
