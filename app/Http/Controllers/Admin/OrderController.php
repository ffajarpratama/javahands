<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function details($id)
    {
        $order = Order::query()
            ->with(['carts', 'carts.product', 'user'])
            ->findOrFail($id);
        return view('admin.order.details', compact('order'));
    }

    public function updateOrderProgress(Request $request, $id)
    {
        $order = Order::query()->find($id);
        $order->update([
            'order_progress' => $request->order_progress,
            'receipt_number' => $request->receipt_number
        ]);
        return redirect()->route('admin.order.details', $order->id)->with('success', 'Order progress updated!');
    }
}
