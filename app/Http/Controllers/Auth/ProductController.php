<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Exception;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product=$product;

        $this->middleware(['auth:admin', 'role:admin|super admin']);

        $this->middleware('permission:create product|edit product|delete product');

        $this->middleware('permission:create product', ['only' => ['create', 'store']]);

        $this->middleware('permission:edit product', ['only' => ['edit', 'update']]);

        $this->middleware('permission:delete product', ['only' => ['delete']]);
    }

    public function index(){
        $products=$this->product->paginate(10);
        return view('admin.content.product.index',compact('products'));
    }

    public function detail($id){
        $product = $this->product->find($id);
        return view('admin.content.product.productDetail', compact('product'));
    }

    public function create(){
        // $cities = City::orderBy('name')->get();
        return view('admin.content.product.add');
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'categorized' => $request->categorized,
                'brand' => $request->brand,
                'series' => $request->series,
                'scale' => $request->scale,
                'product_line' => $request->product_line,
                'height' => $request->height,
                'price' => $request->price,
                'unit' => $request->unit,
                'description' => $request->description,
            ];

            $dataFile = array();

            if ($request->hasFile('link_img')) {
                foreach($request->file('link_img') as $file){
                    $fileNameOrigin = $file->getClientOriginalName();
                    $fileNameHash = Str::random(20) . '.' . $fileNameOrigin;

                    $filePath = $file->storeAs('public/product_images', $fileNameHash);
                    $dataFile[] = [
                        'file_name' => $fileNameHash,
                        'file_path' => Storage::url($filePath)
                    ];
                }
            }

            if(!empty($dataFile)){
                foreach($dataFile as $img){
                    $data['link_img'][] = $img['file_name'];
                }
            }
            else{
                $data['link_img'] = NULL;
            }

            Product::create($data);

            DB::commit();
            session()->flash('success', 'Bạn đã thêm thành công.');
            return redirect()->route('admin.product.index');

        }
        catch(Exception $exception){

            DB::rollBack();

        }
    }

    public function edit($id){
        $product=$this->product->find($id);
        // $cities = City::orderBy('name')->get();
        return view('admin.content.product.edit',['product' => $product]);
    }

    public function update($id,Request $request){
        try{
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'categorized' => $request->categorized,
                'brand' => $request->brand,
                'series' => $request->series,
                'scale' => $request->scale,
                'product_line' => $request->product_line,
                'height' => $request->height,
                'price' => $request->price,
                'unit' => $request->unit,
                'description' => $request->description,
            ];

            $dataFile = array();

            if ($request->hasFile('link_img')) {
                $link_img_old=$this->product->find($id)->link_img;

                if(empty($link_img_old)){
                    foreach($request->file('link_img') as $file){
                        $fileNameOrigin = $file->getClientOriginalName();
                        $fileNameHash = Str::random(20) . '.' . $fileNameOrigin;
    
                        $filePath = $file->storeAs('public/product_images', $fileNameHash);
                        $dataFile[] = [
                            'file_name' => $fileNameHash,
                            'file_path' => Storage::url($filePath)
                        ];
                    }
                }
                else{
                    foreach($link_img_old as $img){
                        $linkPath = 'public/product_images/' . $img;
    
                        Storage::delete($linkPath);
                    }

                    $dataFile = array();

                    foreach($request->file('link_img') as $file){
                        $fileNameOrigin = $file->getClientOriginalName();
                        $fileNameHash = Str::random(20) . '.' . $fileNameOrigin;

                        $filePath = $file->storeAs('public/product_images', $fileNameHash);
                        $dataFile[] = [
                            'file_name' => $fileNameHash,
                            'file_path' => Storage::url($filePath)
                        ];
                    }
                }
                if(!empty($dataFile)){
                    foreach($dataFile as $img){
                        $data['link_img'][] = $img['file_name'];
                    }
                }
                else{
                    $data['link_img'] = NULL;
                }
            }

            $this->product->find($id)->update($data);

            DB::commit();
            session()->flash('success', 'Bạn đã sửa thành công.');
            return redirect()->route('admin.product.index');

        }
        catch(Exception $exception){
            DB::rollBack();

        }
    }

    public function delete($id){
        $product = $this->product->find($id);

        $product_image = 'public/product_images/';

        Storage::delete($product_image);

        $product->delete();

        session()->flash('success', 'Bạn đã xóa thành công.');

        return redirect()->route('admin.product.index');
    }
}
