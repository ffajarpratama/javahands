<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class AuthController extends Controller
{
    public function getRegisterPage()
    {
        //url: /register
        //render view /views/auth/register-first-step
        return view('auth.register-first-step');
    }

    public function storeUserDetails(Request $request)
    {
        //validasi input
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        //buat model baru dari user, isi dengan data data yang diinput
        $user = new User();
        $password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $password;
        //simpan user ke dalam session dengan nama user
        $request->session()->put('user', $user);

        //redirect ke register step kedua
        return redirect()->route('register.address');
    }

    public function getStepTwoRegisterPage()
    {
        //cek kalo session dengan nama user ada
        if (!session()->has('user')) {
            //kalo gada, redirect ke landing page
            return redirect('/');
        }

        //country dan state pake package
        //ambil semua data country dari table countries
        $countries = Country::all();
        //ambil smeua data state/province dari table states
        $states = State::all();
        return view('auth.register-step-two', compact('countries', 'states'));
    }

    //method buat dependent dropdown
    public function getStates($id)
    {
        //ambil state/province berdasarkan id country
        $states = State::query()
            ->where('country_id', $id)
            ->pluck('name', 'id');
        //return data state/province dalam bentuk json
        //response yang direturn diambil sama axios di bagian script buat dependent dropdown
        //script axios buat dependent dropdown ada di /views/auth/register-step-two
        //dan semua view yang butuh dependent dropdown
        //contoh: url: user/order/create sama user/profile/{id user}
        return response()->json($states);
    }

    public function storeUserToDatabase(Request $request)
    {
        //ambil session dengan nama user
        $user = $request->session()->get('user');
        //ambil id state berdasarkan id state yang dipilih
        $state_id = State::query()
            ->where('id', $request->state)
            ->value('id');

        //validasi input
        $request->validate([
            'state' => ['required'],
            'city' => ['required'],
            'zip_code' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required']
        ]);

        //lengkapin kolom kolom yang ada di table user
        $user->state_id = $state_id;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        //save user ke database
        $user->save();
        //log in user otomatis setelah register
        Auth::login($user);
        //hapus session dengan nama user
        $request->session()->forget('user');

        //redirect ke url: /product
        return redirect()->route('product.index');
    }

}
