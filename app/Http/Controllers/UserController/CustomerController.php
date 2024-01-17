<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer=$customer;
        $this->middleware(['auth:customer']);
    }

    public function index(){
        $id = Auth::user()->id;
        // $cities = City::orderBy('name')->get();
        
        $customer = $this->customer->find($id);
        $orders = DB::table('orders')
            ->select('statusPay', 'statusDeli', 'typePay', 'note')
            ->where('id_customer', '=', $id)
            ->orderBy('updated_at', 'desc')
            ->first();
        $name = $this->convert_name($this->customer->find($id)->name);
        $name = str_replace('-', '', $name);
        return view('front-end.auth.account',['customer' => $customer, 'name' => $name], compact('orders'));
    }
    // public function verify(){
    //     $id = Auth::user()->id;
    //     $verify =  $this->convert_name($this->customer->find($id)->verify);
    //     dd($verify);
    //     return view('front-end.components.header', ['verify' => $verify]);
    // }
    public function edit(){
        $id = Auth::user()->id;

        $customer = $this->customer->find($id);

        $name = $this->convert_name($this->customer->find($id)->name);

        $name = str_replace('-', '', $name);

        return view('front-end.auth.profile', ['customer' => $customer, 'name' => $name]);
    }

    public function update(Request $request){
        $id = Auth::user()->id;
        try{
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|max:255',
                // 'username' => 'required|max:255',
                'email' => 'required|max:255',
                // 'link_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
            ];

            $name = $this->convert_name($request->name);

            $name = str_replace('-', '', $name);

            if ($request->hasFile('link_img')) {
                $dataFile = array();
                $file = $request->SSN_front;
                $fileNameOrigin = $file->getClientOriginalName();
                $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalName();
    
                $name = $this->convert_name($request->name);
    
                $name = str_replace('-', '', $name);
    
                $filePath = $request->file('link_img')->storeAs('public/customer_avatar/', $fileNameHash);
                $dataFile = [
                    'file_name' => $fileNameHash,
                    'file_path' => Storage::url($filePath)
                ];
    
                if(!empty($dataFile)){
                    $data['link_img'] = $dataFile['file_name'];
                }
                else{
                    $data['link_img'] = NULL;
                }
            }           
            $this->customer->find($id)->update($data);

            DB::commit();
            session()->flash('success', 'Bạn đã sửa thành công.');
            return redirect()->route('account.index');

        }
        catch(Exception $exception){
            DB::rollBack();
        }
    }
    public static function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}
}
