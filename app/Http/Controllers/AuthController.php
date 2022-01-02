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
        return view('auth.register-first-step');
    }

    public function storeUserDetails(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = new User();
        $password = Hash::make($request->password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $password;
        $request->session()->put('user', $user);

        return redirect()->route('register.address');
    }

    public function getStepTwoRegisterPage()
    {
        if (!session()->has('user')) {
            return redirect('/');
        }

        $countries = Country::all();
        $states = State::all();
        return view('auth.register-step-two', compact('countries', 'states'));
    }

    public function getStates($id)
    {
        $states = State::query()
            ->where('country_id', $id)
            ->pluck('name', 'id');
        return response()->json($states);
    }

    public function storeUserToDatabase(Request $request)
    {
        $user = $request->session()->get('user');
        $state_id = State::query()
            ->where('id', $request->state)
            ->value('id');

        $request->validate([
            'state' => ['required'],
            'city' => ['required'],
            'zip_code' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required']
        ]);

        $user->state_id = $state_id;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->save();
        Auth::login($user);
        $request->session()->forget('user');

        return redirect()->route('home');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'zip_code' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required']
        ]);
        $user = User::query()
            ->where('id', auth()->id())
            ->first();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'state_id' => $request->state,
            'address' => $request->address,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->back()->with('success', 'Contact and shipping details updated!');
    }

}
