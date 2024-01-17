<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Storage;

use Exception;

class OrderController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        $this->order=$order;

        $this->middleware(['auth:admin', 'role:admin|super admin']);
    }

    public function index(){

        $customer = DB::table('customer')
            ->select('id', 'name', 'email', 'phone_number');
        $orderdetail = DB::table('orderdetail')
            ->select('id_order', DB::raw('SUM(price) AS total'))
            ->groupBy('id_order');
        $orders = DB::table('orders')
            ->joinSub($customer, 'customer', function($join1){
                $join1->on('orders.id_customer', '=', 'customer.id');
            })
            ->joinSub($orderdetail, 'orderdetail', function($join2){
                $join2->on('orderdetail.id_order', '=', 'orders.id');
            })
            ->select('orders.id', 'orders.id_package', 'customer.name', 'customer.email', 'customer.phone_number',
            'orders.statusPay', 'orders.statusDeli', 'orders.typePay', 'orders.created_at', 'orders.updated_at',
            'orderdetail.total')
            ->orderBy('orders.created_at', 'desc')
            ->orderBy('statusPay', 'asc')->latest()
            ->paginate(10);

        return view('admin.content.order.orderIndex',compact('orders'));
    }

    public function detail($id){

        $customer = DB::table('customer')
            ->select('id', 'name', 'email', 'address', 'phone_number', 'link_img');
        $orders = DB::table('orders')
            ->joinSub($customer, 'customer', function($join1){
                $join1->on('orders.id_customer', '=', 'customer.id');
            })
            ->select('orders.id', 'customer.name', 'customer.email', 'customer.address', 'customer.phone_number', 'customer.link_img',
                'orders.statusPay', 'orders.statusDeli', 'orders.typePay')
            ->where('orders.id',$id)
            ->first();

        $goods_quantity = DB::table('orderdetail')
            ->where('id_order', $id)
            ->sum('quantity');

        $total = DB::table('orderdetail')
            ->where('id_order', $id)
            ->sum('price');

        $products = DB::table('product')
            ->select('id', 'name', 'categorized', 'brand');           
        $order_detail = DB::table('orderdetail')
            ->joinSub($products, 'product', function($join1){
                $join1->on('orderdetail.id_product', '=', 'product.id');
            })
            ->select('product.id', 'product.name', 'product.categorized', 'product.brand', 'orderdetail.quantity', 'orderdetail.price')
            ->where('orderdetail.id_order',$id)
            ->orderBy('id_order')
            ->paginate(5);

        return view('admin.content.order.orderDetail', compact('orders', 'goods_quantity', 'total', 'order_detail', 'id'));
    }

    public function verify($id,Request $request)
    {
        try{
            DB::beginTransaction();
            $data = [
                'statusPay' => $request->statusPay,
                'statusDeli' => $request->statusDeli,
                'typePay' => $request->typePay
            ];

            $this->order->find($id)->update($data);
            DB::commit();

            session()->flash('success', 'Bạn đã cập nhật trạng thái thành công.');
            return redirect()->route('admin.order.orderIndex');
            // return view('admin.content.order.orderStatus');
        }
        catch(Exception $exception){
            DB::rollBack();
        }
    }

    public function create($id){
        $orderdetail = OrderDetail::all();

        $customer = Customer::find($id);

        return view('admin.content.order.add', ['orderdetail' => $orderdetail, 
                                                'customer' => $customer]);
    }

    public function store($id_cus, Request $request){
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

            // $customer = Customer::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'address' => $request->address,
            //     'phone_number' => $request->phone_number,
            // ]);

            $data_order = [
                'id_customer' => $customer->id,  
                'statusPay' => $request->statusPay,
                'statusDeli' => $request->statusDeli,
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
        return view('admin.content.order.edit',['orderdetail' => $orderdetail,
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

    public function delete($id){

        try{
            DB::beginTransaction();

            OrderDetail::where('id_order',$id)->delete();
            Order::where('id',$id)->delete();

            session()->flash('success', 'Bạn đã xóa thành công.');
            return redirect()->route('admin.order.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
        
    }
    
    public function getLoaiHinhThuc(Request $request)
    {
        $loai_hinhthuc = FormType::where('hinhthuc_id', '=', $request->hinhthuc)->orderBy('name')->get();
        return $loai_hinhthuc;
    }
}
