<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('admin.auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'telephone' => 'required|max:11',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone_number' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        $admin->assignRole('staff');

        auth('admin')->attempt($request->only('username', 'password'));

        return redirect()->route('admin.home');

    }
}
