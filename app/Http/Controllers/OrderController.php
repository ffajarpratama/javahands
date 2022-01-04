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
    public function index()
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $orders = Order::query()
            ->with(['carts', 'carts.product'])
            ->where('user_id', $user->id)
//            ->where('payment_status', '=','CREATED')
            ->latest()
            ->get();
//        return $orders;
        return view('user.order.index', compact('user', 'orders'));
    }

    public function create()
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', $user->id)
            ->where('order_id', null)
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
            ->where('order_id', null)
            ->get();
        $shipping_price = $request->shipping_price;
        $total_order_price = $carts->sum('sub_total') + $shipping_price;
        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'shipping_price' => $shipping_price,
            'receipt_number' => null,
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
        return redirect()->route('user.order.details', $order->id)->with('success', 'Order has been placed!');
    }

    public function details($id)
    {
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $order = Order::query()
            ->with(['user', 'carts', 'carts.product'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('user.order.details', compact('order', 'user'));
    }

    public function received($id)
    {
        $order = Order::query()->find($id);
        $order->update([
            'order_progress' => 'RECEIVED'
        ]);
        return redirect()->route('user.order.details', $order->id)->with('success', 'Confirmation has been sent to our admin!');
    }
}
