<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ForgetPassController extends Controller
{
    public function forgetPass(){
        return view('front-end.auth.forgetPass');
    }
    public function forgetPassStore(Request $request){
        //$id = Auth::user()->id;
        $request->validate([
            'email' => 'required|exists:customer'
        ],[
            'email.required' => 'Vui lòng nhập email hợp lệ',
            'email.exists' => 'Email này không tồn tại trong hệ thống'
        ]);
        $token = strtoupper(Str::random(10));
        $data = [
            'token' => $request->token
        ];
        
        $data['token'] = $token;
        //dd($data, $token);
        DB::table('customer')->where('email', $request->email)->update($data);
        
        $cus = DB::table('customer') -> where('email', $request->email) ->first();
        //dd($token, $cus);
        try {
            Mail::send('front-end.email.email-check-forgetpass', compact('cus'), function($email) use($cus) {
                $email -> subject('BatDongSan.Com - Lấy lại mật khẩu tài khoản');
                $email -> to($cus-> email, $cus -> name);
            });
        } catch (\Throwable $th) {
            return redirect() -> back() -> with('no', 'abc');
        }
        return redirect() -> back() -> with('yes', 'Vui lòng check mail để thực hiện thay đổi mật khẩu');
    }
    public function getPass(int $id, $token){
        $cus = DB::table('customer') -> where('id', $id) -> first();
        if($cus->token == $token){
            return view('front-end.contents.customer.account-manager.getPass');
        }
        return abort(404);
    }

    public function getPassStore(int $id, $token, Request $request){
        $request -> validate([
            'password' => 'required',
            'confirmpass' => 'required|same:password',
        ]);
        $data = [
            'password' => $request -> password,
            'token' => $token
        ];
        $data['password'] = bcrypt($request -> password);
        //$data['password'] = $request -> password;
        $data['token'] = null;
        //dd($data);
        DB::table('customer')->where('id', $id)->update($data);
        return redirect() -> route('account.index') -> with('yes', 'Đổi mật khẩu thành công');
    }

    public function changePass(){
        
        return view('front-end.auth.updatePass',);
    }

    public function changePassStore(Request $request){
        $id = Auth::user()->id;
        $cus = DB::table('customer') -> where('id', $id) -> first();
        if(Hash::check($request -> password, $cus-> password)){
            if($request -> newpass == $request -> confirmpass){
                $data = [
                    'password' => $request -> password
                ];
                $data['password'] = Hash::make($request -> password);
                DB::table('customer')->where('id', $id)->update($data);
                return redirect() -> route('account.index') -> with('yes', 'Đổi mật khẩu thành công');
            }
            else{
                return redirect() -> back() -> with('no1', 'Mật khẩu nhập lại không đúng');
            }
           
        }
        else{
            return redirect() -> back() -> with('no2', 'Sai mật khẩu');
        }
    }
}
