<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class CustomerManagerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer=$customer;

        $this->middleware(['auth:admin', 'role:admin|staff|super admin']);

        $this->middleware('permission:create customer|edit customer|delete customer');

        $this->middleware('permission:create customer', ['only' => ['create', 'store']]);

        $this->middleware('permission:edit customer', ['only' => ['edit', 'update']]);

        $this->middleware('permission:delete customer', ['only' => ['delete']]);
    }

    public function index(){
        $customers = $this->customer->paginate(5);
        return view('admin.content.customer.index', ['customers' => $customers]);
    }

    public function detail(int $id){
        $customer = $this->customer->find($id);

        $name = $this->convert_name($this->customer->find($id)->name);

        $name = str_replace('-', '', $name);

        return view('admin.content.customer.customerDetail', ['customer' => $customer, 'name' => $name]);
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

    public function create (){
        return view('admin.content.customer.add');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
            'link_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'link_img' => $request->link_img,
        ];

        if ($request->hasFile('link_img')) {
            $dataFile = array();
            $file = $request->link_img;
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

        $this->customer->create($data);

        return redirect()->route('admin.customer.index');

    }

    public function edit(int $id){
        $customer = $this->customer->find($id);

        // $cities = City::orderBy('name')->get();

        $name = $this->convert_name($this->customer->find($id)->name);

        $name = str_replace('-', '', $name);

        return view('admin.content.customer.edit', ['customer' => $customer, 'name' => $name]);
    }

    public function update(int $id, Request $request){
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
                'email' => $request->email,
                // 'username' => $request->username,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ];

            $name = $this->convert_name($request->name);

            $name = str_replace('-', '', $name);
            $this->customer->find($id)->update($data);

            DB::commit();
            session()->flash('success', 'Bạn đã sửa thành công.');
            return redirect()->route('admin.customer.index');

        }
        catch(Exception $exception){
            DB::rollBack();

        }
    }

    public function delete(int $id){
        $customer = $this->customer->find($id);

        $name = $this->convert_name($customer->name);

        $name = str_replace('-', '', $name);

        $link_img = 'public/customer_avatar/' . $name;

        $this->customer->find($id)->delete();

        Storage::delete($link_img);

        session()->flash('success', 'Bạn đã xóa thành công.');

        return redirect()->route('admin.customer.index');
    }
}
