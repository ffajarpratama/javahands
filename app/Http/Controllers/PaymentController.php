<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function storePayment($id)
    {
        $order = Order::query()->find($id);
        $order->update([
            'payment_status' => 'PAID'
        ]);
        return redirect()->route('user.order.details', $order->id)->with('success', 'Thank you for your purchase!');
    }
}
