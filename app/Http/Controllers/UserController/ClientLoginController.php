<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientLoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('customer');
    }

    public function index(){
        if(auth('customer')->check()){
            return redirect()->back();
        }
        return view('front-end.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        $input = $request->all();
        //dd(Auth::attempt($request->only('username', 'password')));
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth('customer')->attempt(array($fieldType => $input['username'], 'password' => $input['password']))) {
            $request->session()->regenerate();
            return redirect()->route('client.home'); // change to account manager when fe finished
        }

        return back()->withErrors([
            'username' => 'Sai tên đăng nhập hoặc mật khẩu',
        ]);
    }
}
