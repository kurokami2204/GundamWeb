<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Events\ClientPostNews;
use App\Events\ClientRegister;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Psy\CodeCleaner\FunctionContextPass;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;


class TestSubmit extends Controller
{
    private $product;
    public function index($id){
        // $land = News::whereNotNull('id_dat')->get();
        // $orders = DB::table('orders')
        // ->get()
        // ->paginate(10);
        

        // $customer = DB::table('customer')
        //     ->select('id', 'name', 'email', 'phone_number',)
        //     ->orderBy('id')
        //     ->get();
        // $products = DB::table('product')
        //     ->select('name', 'categorized', 'brand', 'price', DB::raw('SUBString(link_img,1,1) as link_img'))
        //     ->paginate(30);
        // $orderdetail = DB::table('orderdetail')
        //     ->select('id_order',DB::raw('SUM(price) AS total'))
        //     ->groupBy('id_order');
        //     // ->get();

        // $orders = DB::table('orders')
        //     ->joinSub($customer, 'customer', function($join1){
        //         $join1->on('orders.id_customer', '=', 'customer.id');
        //     })
        //     ->joinSub($orderdetail, 'orderdetail', function($join2){
        //         $join2->on('orderdetail.id_order', '=', 'orders.id');
        //     })
        //     ->select('orders.id_package', 'customer.name', 'customer.email', 'customer.phone_number',
        //     'orders.statusPay', 'orders.statusDeli', 'orders.typePay', 'orders.created_at', 'orders.updated_at',
        //     'orderdetail.total')
        //     ->orderBy('orders.created_at', 'desc')
        //     ->orderBy('statusPay', 'asc')->latest()
        //     ->paginate(10);

        // $orderdetail = DB::table('orderdetail')
        //     ->select('id_order', DB::raw('SUM(quantity) AS goods_quantity'), DB::raw('SUM(price) AS total'))
        //     ->where('id_order', $id)
        //     ->groupBy('id_order')
        //     ->get();

        // $orders = DB::table('orders')
        //     ->joinSub($customer, 'customer', function($join1){
        //         $join1->on('orders.id_customer', '=', 'customer.id');
        //     })
        //     ->select('customer.name', 'customer.email', 'customer.address', 'customer.phone_number', 'customer.link_img')
        //     ->where('orders.id',$id)
        //     ->first();
        
        // $products = DB::table('product')
        //     ->select('id', 'name', 'categorized', 'brand');
            
        // $orderproduct = DB::table('orderdetail')
        //     ->joinSub($products, 'product', function($join1){
        //         $join1->on('orderdetail.id_product', '=', 'product.id');
        //     })
        //     ->select('product.name', 'product.categorized', 'product.brand', 'orderdetail.quantity', 'orderdetail.price')
        //     ->where('orderdetail.id_order',$id)
        //     ->orderBy('id_order')
        //     ->paginate(5);
        // $customers = Customer::orderBy('id')->get();

        $product = DB::table('product')->find($id);
        $category =$product->categorized;
        $products = DB::table('product')
            ->select('name', 'categorized', 'brand', 'price', 'link_img')
            ->where('categorized',$category)
            ->get();

        
        dd($products);

        return view('submitForm',[compact('product','products')]);
        
    }

    // public function submit(Request $request){

    //     dd($request->add_permission);
    //     return view('submitForm');
    // }
}
