<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //method buat lihat order detail untuk admin
    public function details($id)
    {
        //url: /admin/order/details/{id order}
        //cari order dimana id sama dengan id order yang ada di url
        $order = Order::query()
            ->with(['carts', 'carts.product', 'user'])
            ->findOrFail($id);

        //render view: /admin/order/details/ dengan variable order
        return view('admin.order.details', compact('order'));
    }

    //method buat update kolom order_progress di table orders
    public function updateOrderProgress(Request $request, $id)
    {
        //url: /admin/order/updateOrderProgress/{id order}
        //cari order dimana id sama dengan id order yang ada di url
        $order = Order::query()->find($id);

        //update order_progress sesuai dengan pilihan yang dipilih pada dropdown order progress
        //update receipt number dari input
        $order->update([
            'order_progress' => $request->order_progress,
            'receipt_number' => $request->receipt_number
        ]);

        //redirect ke url: /admin/order/details/{id dari order yang didapat di atas} dengan pesan sukses
        return redirect()->route('admin.order.details', $order->id)->with('success', 'Order progress updated!');
    }
}
