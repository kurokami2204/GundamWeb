<?php

namespace App\Http\Controllers\UserController;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Exception;

class CartController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth:customer');
        $this->product=$product;
    }

    public function store(Request $request){
        $product = Product::findOrFail($request->input('product_id'));
        // Cart::destroy();
        switch($request->input('store')){
            case 'cart':
                Cart::instance('cart')->add([
                    'id' => $product -> id, 
                    'name' => $product -> name, 
                    'qty' => $request->input('quantity'), 
                    'price' => $product -> price,
                    'weight' => 0,
                    'options' =>  ['category' => $product -> categorized,'brand' => $product -> brand, 'link_img' => $product -> link_img],
                ]);
        
                return redirect()->route('product.index')->with('message', 'Successfully Added To Cart ');
                break;
            case 'wishlist':
                if($product -> unit > 0 ){
                    Cart::instance('wishlist')->add([
                        'id' => $product -> id, 
                        'name' => $product -> name, 
                        'qty' => $product -> unit, 
                        'price' => $product -> price,
                        'weight' => 0,
                        'options' =>  ['category' => $product -> categorized,'brand' => $product -> brand, 'link_img' => $product -> link_img],
                    ]);
                }else{
                    Cart::instance('wishlist')->add([
                        'id' => $product -> id, 
                        'name' => $product -> name, 
                        'qty' => -1, 
                        'price' => $product -> price,
                        'weight' => 0,
                        'options' =>  ['category' => $product -> categorized,'brand' => $product -> brand, 'link_img' => $product -> link_img],
                    ]);
                }
                return redirect()->route('product.index')->with('message', 'Successfully Added To Wishlist ');
                break;
        }    
    }

    public function indexCart(){
        $cart = Cart::instance('cart')->content();
        return view('front-end.contents.cart',compact('cart'));
    }

    public function indexWishlist(){
        $products = Product::all();
        $id = Auth::user()->id;
        $customer = Customer::find($id);
        $wishlist = Cart::instance('wishlist')->content();
        return view('front-end.contents.wishlist',compact('wishlist','customer','products'));
    }

    public function removeItem($rowId){
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function removeItemWishlist($rowId){
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->route('wishlist.index');
    }
    public function updateItem($rowId,Request $request){
        $item = Cart::instance('cart')->get($rowId);
        $quantity = $item -> qty;
        switch($request->input('quantity')){
            case 'up':
                Cart::instance('cart')->update($rowId,$quantity + 1 );
                break;
            case 'down':
                Cart::instance('cart')->update($rowId,$quantity - 1 );
                break;
        }
        

        return redirect()->route('cart.index',compact('item','quantity'));
    }

    public function fakeCheckout(Request $request){
        switch($request->input('checkout')){
            case 'checkout':
                Cart::instance('cart')->destroy();
                return view('front-end.contents.checkOutSuccess');
                break;
        }
        
        
    }
}
