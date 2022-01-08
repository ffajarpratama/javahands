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
    //method buat ambil semua order user yang login
    public function index()
    {
        //url: /user/order/
        //cari user dimana id sama dengan id user yang login
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        //ambil semua order dari user
        $orders = Order::query()
            ->with(['carts', 'carts.product'])
            ->whereHas('carts')
            ->where('user_id', $user->id)
            ->latest()
            ->get();
        //render view /user/order/index
        return view('user.order.index', compact('user', 'orders'));
    }

    //method buat bikin order/checkout
    public function create()
    {
        //url: /user/order/create
        //cari user dimana id sama dengan id user yang login
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        //ambil semua cart dari user
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', $user->id)
            //dimana order_id = null (belum diorder/checkout)
            ->where('order_id', null)
            ->get();
        //ambil semua data country
        $countries = Country::all();
        //ambil semua data state
        $states = State::all();

        //kalo state_id di table users ga null (alamat user lengkap + country sama state)
        if ($user->state) {
            //ambil country_di pake method getCountryId di model user
            $userCountryId = $user->getCountryId();
            //ambil state dimana country_id pada table states = country_id yang dimiliki user
            //semua state/province di country itu diambil untuk ngisi state dropdown yang ada halaman user/order/create
            $states = State::query()
                ->where('country_id', $userCountryId)
                ->get();
        }

        //render view: /views/user/order/create
        return view('user.order.create', compact('user', 'carts', 'countries', 'states'));
    }

    //method buat save order ke database
    public function store(Request $request)
    {
        //ambil semua carts dimana user_id sama dengan id user yang login
        $carts = Cart::query()
            ->with('product')
            ->where('user_id', auth()->id())
            //dimana order_id = null (belum diorder/checkout)
            ->where('order_id', null)
            ->get();

        //ambil shipping price dari input, lalu ubah shipping price ke integer
        $base_shipping_price = (Int)$request->shipping_price;
        //set additional charge per kilo
        $additional_charge = 15;

        //ambil sum dari total weight di carts, lalu dibulatkan
        $total_weight = round($carts->sum('total_weight'));
        //ambil sum dari sub total di carts
        $sub_total = $carts->sum('sub_total');

        //jika total weight > 1
        if ($total_weight > 1) {
            //total weight - 1
            $total_weight = $total_weight - 1;
            //shipping price = base shipping price + (total weight yang sudah dikurangi 1 * 15)
            $shipping_price = $base_shipping_price + ($total_weight * $additional_charge);
        } else {
            //jika total weight kurang dari sama dengan 1
            //shipping price = base shipping price
            $shipping_price = $base_shipping_price;
        }

        //order price = shipping price + sub total
        $order_price = $shipping_price + $sub_total;

        //set invoice number sebanyak 14 digit
        $invoice_number = rand(10000000000000, 99999999999999);
        //save order ke database
        $order = Order::query()->create([
            'user_id' => auth()->id(),
            'shipping_price' => $shipping_price,
            'receipt_number' => null,
            'total_price' => $order_price,
            //saat order pertama kali dibuat, progress order = in_packaging/sedang dikemas
            'order_progress' => 'IN_PACKAGING',
            //dengan payment_status created/menunggu pembayaran
            'payment_status' => 'CREATED',
            'invoice_number' => $invoice_number
        ]);

        //untuk setiap cart dari user yang login, update order_id di table carts dengan id order yang barusan dibuat
        //update cart satu persatu pake foreach
        //perlu di-foreach karena relasi order one to many sama cart, yang berarti di table carts ada kolom order_id
        //kalo di table carts ada order_id, buat dapetin semua detail cart dan products yang diorder bisa pake
        //order->carts->product
        //note: carts itu collection, jadi perlu di-foreach di blade
        foreach ($carts as $cart) {
            $cart->update([
                'order_id' => $order->id
            ]);
        }

        //redirect ke url: /user/order/details/{id order} dengan pesan sukses
        return redirect()->route('user.order.details', $order->id)->with('success', 'Order has been placed!');
    }

    //method untuk lihat detail order
    public function details($id)
    {
        //url: /user/order/details/{id order}
        //cari user dengan id sama dengan id user yang login
        $user = User::query()
            ->where('id', auth()->id())
            ->first();

        //cari order dengan id sama dengan id order di url
        $order = Order::query()
            ->with(['user', 'carts', 'carts.product'])
            ->where('id', $id)
            //dimana user_id sama dengan id user
            ->where('user_id', $user->id)
            ->firstOrFail();

        //render view: /views/user/order/details
        return view('user.order.details', compact('order', 'user'));
    }

    public function received($id)
    {
        //url: /user/order/received/{id order}
        //cari order dimana id sama dengan id order di url
        $order = Order::query()->find($id);
        //update order_progress menjadi received/telah diterima
        $order->update([
            'order_progress' => 'RECEIVED'
        ]);

        //redirect ke url: /user/order/details/{id dari order sebelumnya} dengan pesan sukses
        return redirect()->route('user.order.details', $order->id)->with('success', 'Confirmation has been sent to our admin!');
    }
}
