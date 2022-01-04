<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\Country;
use WisdomDiala\Countrypkg\Models\State;

class ProfileController extends Controller
{
    public function getUserProfile($id)
    {
        $user = User::query()->find($id);
        $countries = Country::all();
        $states = State::all();
        return view('auth.profile', compact('user', 'countries', 'states'));
    }

    public function updateProfile(Request $request, $id)
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
        $user = User::query()->find($id);
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
