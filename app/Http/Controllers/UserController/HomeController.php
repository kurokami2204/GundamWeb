<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $product;
    public function __construct(Product $product)
    {
        
        $this->product=$product;
    }
    public function index(){
        $products = Product::get();
        return view('front-end.contents.home', ['products' => $products]);
    }
    // public function getLoaiHinhThuc()
    // {
    //     $loai_hinhthuc = FormType::where('hinhthuc_id', '=', '1')->orderBy('name')->get();
    //     dd($loai_hinhthuc);
    //     return $loai_hinhthuc;
    // }

    // public function homelist($id){
    //     //dd($id);
    //     $cities = City::orderBy('name')->get();
    //     $home = News::whereNotNull('id_nha') -> where('status', '=', 2)->where('loai_hinhthuc_id', '=', $id)->orderBy('id_type', 'desc')
    //     ->orderBy('startTime', 'desc')->paginate(10);
    //     //dd($home);
    //     return view('front-end.contents.estate.homeList', ['cities' => $cities, 'home' => $home]);
    // }
    // public function landList($id){
    //     $cities = City::orderBy('name')->get();
    //     $land = News::whereNotNull('id_dat')->where('status', '=', 2)->where('loai_hinhthuc_id', '=', $id)->orderBy('id_type', 'desc')
    //     ->orderBy('startTime', 'desc')->paginate(10);
    //     // dd($home);
    //     return view('front-end.contents.estate.landList', ['cities' => $cities, 'land' => $land]);
    // }
}
