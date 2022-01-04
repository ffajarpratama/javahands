<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //method untuk dashboard admin
    public function dashboard()
    {
        //ambil semua data order diurutkan dari tanggal order
        $orders = Order::query()
            ->with(['carts', 'carts.product', 'carts.user'])
            ->latest()
            ->get();

        //render view: /views/admin/dashboard dengan variable orders
        return view('admin.dashboard', compact('orders'));
    }
}
