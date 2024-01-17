<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Storage;

use Exception;

class OrderDetailController extends Controller
{
    private $order_detail;

    public function __construct(OrderDetail $order_detail)
    {
        $this->order_detail=$order_detail;

        $this->middleware(['auth:admin', 'role:admin|super admin']);
    }

    public function create(){
        $customers = DB::table('customer')
            ->select('id', 'name', 'email', 'phone_number')
            ->orderBy('id')
            ->get();
        $products = DB::table('product')
            ->select('id', 'name', 'categorized', 'brand', 'unit', 'price')
            ->orderBy('id')
            ->get();

        // $orders = DB::table('orders')
        //     ->select('typePay')
        //     ->get();
        // $orderdetail = OrderDetail::all();

        return view('admin.content.order.add',compact('customers', 'products'));
    }

    
    public function searchCustomer(Request $request){     
        $search = $request->search;
        if($search == ''){
            $customers = DB::table('customer')
            ->select('id', 'name', 'phone_number', 'email')
            ->limit(5)
            ->get();          
        } else {
            $customers = DB::table('customer')
            ->select('id', 'name', 'phone_number', 'email')
            ->where('id', 'like', '%' . $search . '%')
            ->orwhere('name', 'like', '%' . $search . '%')
            ->orwhere('phone_number', 'like', '%' . $search . '%')
            ->orwhere('email', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();
        }
        $response = array();
        foreach($customers as $customer){
            $response[] = array(
                'id'=>$customer->id,
                'name'=>$customer->name,
                'phone_number'=>$customer->phone_number,
                'email'=>$customer->email
            );
        }
        return response()->json($response);
    }

    public function searchProduct(Request $request){     
        $search = $request->search;
        if($search == ''){
            $products = DB::table('product')
            ->select('id', 'name', 'categorized', 'brand', 'price')
            ->get();          
        } else {
            $products = DB::table('product')
            ->select('id', 'name', 'categorized', 'brand', 'price')
            ->where('id', 'like', '%' . $search . '%')
            ->orwhere('name', 'like', '%' . $search . '%')
            ->orwhere('categorized', 'like', '%' . $search . '%')
            ->orwhere('brand', 'like', '%' . $search . '%')
            ->orwhere('price', 'like', '%' . $search . '%')
            ->get();
        }
        $response = array();
        foreach($products as $product){
            $response[] = array(
                'id'=>$product->id,
                'name'=>$product->name,
                'categorized'=>$product->categorized,
                'brand'=>$product->brand,
                'price'=>$product->price
            );
        }
        return response()->json($response);
    }

    public function store($id_customer, Request $request){
        try{
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|max:100',
                'phone_number' => 'required|max:50',
                'typePay' => 'required',
                'quantity' => 'required|min:1'
            ]);

            // $customer = Customer::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'address' => $request->address,
            //     'phone_number' => $request->phone_number,
            // ]);

            $data_order = [
                'id_customer' => $customer->id,
                'id_package' => $request->id_package, 
                'typePay' => $request->typePay,
                'note' => $request->note,    
            ];
            $digits = 7;
            $number = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
            $id_package = 'OD'.$number;
            $check = Orders::select('id_package')->get();
            for ($i=0; $i < $check->count(); $i++) { 
                if ($id_package == $check[$i]) {
                    $number = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                    $id_package = 'OD'.$number;
                    $i=-1;
                }
            }
            $data_order->id_package = $id_package;
            
            $order = new Order($data_order);
            $order->save();

            DB::commit();
            session()->flash('success', 'Bạn đã thêm thành công.');
            return redirect()->route('admin.order.index');

        }
        catch(Exception $exception){

            DB::rollBack();

        }
    }

    public function edit($id, $id_customer){
        $order = $this->order->find($id);
        $orderdetail = OrderDetail::all();
        $customer = Customer::find($id_customer);
        return view('admin.content.order.edit',['orderdetail' => $orderdertail,
                                                'customer' => $customer, 'order' => $order]);
    }

    public function update($id,Request $request){
        try{
            DB::beginTransaction();
            
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|max:255',
                'address' => 'required|max:255',
                'phone_number' => 'required|max:50',
                'statusPay' => 'required',
                'statusDeli' => 'required',
                'typePay' => 'required'
            ]);
            
            $data_order = Order::find($id);

            if ($data_order->typePay == 1 && $request->typePay == 0) {
                $digits = 5;
                $number = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                $id_package = 'DH'.$number;
                $check = Orders::select('id_package')->get();
                for ($i=0; $i < $check->count(); $i++) { 
                    if ($id_package == $check[$i]) {
                        $number = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
                        $id_package = 'DH'.$number;
                        $i=-1;
                    }
                }
                $data_order->id_package = $id_package;
            }

            $data_order = [
                'statusPay' => $request->statusPay,
                'statusDeli' => $request->statusDeli,
                'typePay' => $request->typePay,
                'note' => $request->note,
            ];

            $this->order->find($id)->update($data_order);

            DB::commit();
            session()->flash('success', 'Bạn đã sửa thành công.');
            return redirect()->route('admin.order.index');

        }
        catch(Exception $exception){
            DB::rollBack();

        }
    }
    
    public function getLoaiHinhThuc(Request $request)
    {
        $loai_hinhthuc = FormType::where('hinhthuc_id', '=', $request->hinhthuc)->orderBy('name')->get();
        return $loai_hinhthuc;
    }
}
