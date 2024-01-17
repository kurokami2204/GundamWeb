<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('admin');
    }
    public function index(){
        if(auth('admin')->check()){
            return redirect()->back();
        }
        return view('admin.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        //dd(Auth::attempt($request->only('username', 'password')));
        if (auth('admin')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.home');
        }

        return back()->withErrors([
            'username' => 'Sai tên đăng nhập hoặc mật khẩu',
        ]);
    }
}