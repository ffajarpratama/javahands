<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class OrderController extends Controller
{
    public function create()
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', $user->id)
            ->get();
        $countries = Country::all();
        $states = State::all();

        if ($user->state) {
            $userCountryId = $user->getCountryId();
            $states = State::query()
                ->where('country_id', $userCountryId)
                ->get();
        }

        return view('user.order.create', compact('user', 'carts', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', auth()->id())
            ->get();
        $shipping_price = $request->shipping_price;
        $total_order_price = $carts->sum('sub_total') + $shipping_price;
        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'shipping_price' => $shipping_price,
            'total_price' => $total_order_price,
            'order_progress' => 'IN_PACKAGING',
            'payment_status' => 'CREATED',
            'payment_token' => null
        ]);
        foreach ($carts as $cart) {
            $cart->update([
                'order_id' => $order->id
            ]);
        }
        return redirect()->back()->with('success', 'Order has been placed!');
    }

    public function details()
    {
        $order = Order::query()
            ->with(['user', 'carts', 'carts.product'])
            ->where('user_id', auth()->id())
            ->first();
        return $order->carts;
    }
}
