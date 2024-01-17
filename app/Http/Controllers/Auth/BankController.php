<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;
use Exception;

class BankController extends Controller
{
    private $bank;

    public function __construct(BankAccount $bank)
    {
        $this->bank=$bank;

        $this->middleware(['auth:admin', 'role:admin|staff|super admin']);

        $this->middleware('permission:create bank account|edit bank account|delete bank account');

        $this->middleware('permission:create bank account', ['only' => ['create', 'store']]);

        $this->middleware('permission:edit bank account', ['only' => ['edit', 'update']]);

        $this->middleware('permission:delete bank account', ['only' => ['delete']]);
    }
    public function index(){
        $banks=$this->bank->paginate(5);
        return view('admin.content.bank.index',compact('banks'));
    }

    public function create(){
        return view('admin.content.bank.add');
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $banks=$this->bank->create([
                'bankName'=>$request->bankName,
                'userName'=>mb_strtoupper($request->userName),
                'bankNumber'=>$request->bankNumber,
                'department'=>$request->department
            ]);


            DB::commit();
            session()->flash('success', 'Bạn đã thêm thành công.');
            return redirect()->route('admin.bank.index');

        }
        catch(Exception $exception){

            DB::rollBack();

        }
    }
    public function edit($id){
        $banks=$this->bank->find($id);
        return view('admin.content.bank.edit',compact('banks'));
    }

    public function update($id,Request $request){
        try{
            DB::beginTransaction();
            $this->bank->find($id)->update([
                'bankName'=>$request->bankName,
                'userName'=>mb_strtoupper($request->userName),
                'bankNumber'=>$request->bankNumber,
                'department'=>$request->department
            ]);

            DB::commit();
            session()->flash('success', 'Bạn đã sửa thành công.');
            return redirect()->route('admin.bank.index');

        }
        catch(Exception $exception){
            DB::rollBack();

        }
    }
    public function delete($id){
        $this->bank->find($id)->delete();
        session()->flash('success', 'Bạn đã xóa thành công.');
        return redirect()->route('admin.bank.index');
    }
}
