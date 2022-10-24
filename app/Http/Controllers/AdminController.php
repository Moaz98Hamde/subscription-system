<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function createUser()
    {
        return view('admin.create_user');
    }

    public function editUser(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('customer');

        if ($user) {
            return redirect()->back()->with('success', 'user created successfully');
        }
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['confirmed', Rules\Password::defaults()],
        ]);

        if($request->has('password')){
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());

        if ($user) {
            return redirect()->back()->with('success', 'user updated successfully');
        }
    }

    public function activateUser(User $user){
        $user->status = true;
        $user->save();
        return redirect()->back()->with('success', 'user account activated successfully');
    }

    public function deactivateUser(User $user){
        $user->status = false;
        $user->save();
        return redirect()->back()->with('success', 'user account deactivated successfully');
    }

}
