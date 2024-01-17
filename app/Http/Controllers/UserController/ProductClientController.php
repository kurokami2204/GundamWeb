<?php

namespace App\Http\Controllers\UserController;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Exception;

class ProductClientController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product=$product;
    }

    public function index(){
        // $products = DB::table('product')
            // ->select('name', 'categorized', 'brand', 'price', DB::raw('SUBString(link_img,1,1) as link_img'))
            // ->paginate(10);
        
        $products=$this->product->paginate(9);
        $cart = Cart::instance('cart')->content();
        $wishlist = Cart::instance('wishlist')->content();
        // dd($cart);
        return view('front-end.contents.shop',compact('products'));
    }

    public function detail($id){
        $product = $this->product->find($id);

        $category = $product->categorized ?? 0;
        $products = $this->product
            ->where('categorized', $category)
            ->whereNot('id', $id)
            ->paginate(4);
        return view('front-end.contents.product', compact('product', 'products'));
    }

}
