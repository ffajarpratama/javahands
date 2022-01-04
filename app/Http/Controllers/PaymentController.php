<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //method untuk pembayaran order
    public function storePayment($id)
    {
        //url: /user/order/payment/{id order}
        //cari order dengan id sama dengan id yang ada di url
        $order = Order::query()->find($id);

        //update payment_status dari order menjadi paid/telah dibayar
        $order->update([
            'payment_status' => 'PAID'
        ]);

        //redirect ke url: /user/order/details/{id dari order sebelumnya} dengan pesan sukses
        return redirect()->route('user.order.details', $order->id)->with('success', 'Thank you for your purchase!');
    }
}
