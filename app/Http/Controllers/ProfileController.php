<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class ProfileController extends Controller
{
    //method untuk show profile user yang login
    public function getUserProfile($id)
    {
        //url: /user/profile/{id user}
        //cari user dengan id sama dengan id user pada url
        $user = User::query()->find($id);
        //ambil semua data country
        $countries = Country::all();
        //ambil semua data state
        $states = State::all();

        //render view: /views/auth/profile dengan semua variabel di atas
        return view('auth.profile', compact('user', 'countries', 'states'));
    }

    //method untuk update profile user yang login
    public function updateProfile(Request $request, $id)
    {
        //validasi input
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

        //cari user dimana id sama dengan id user pada url
        $user = User::query()->find($id);
        //update user
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

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Contact and shipping details updated!');
    }
}
