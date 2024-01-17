<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

use Exception;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminListController extends Controller
{
    private $admins;

    public function __construct(Admin $admins)
    {
        $this->admins=$admins;

        $this->middleware(['auth:admin', 'role:admin|staff|super admin']);

        $this->middleware('permission:admin manager|create admin/staff|edit admin/staff|delete admin/staff');

        $this->middleware('permission:admin manager', ['only' => ['index']]);

        $this->middleware('permission:create admin/staff', ['only' => ['add', 'store']]);

        $this->middleware('permission:edit admin/staff', ['only' => ['edit', 'update']]);

        $this->middleware('permission:delete admin/staff', ['only' => ['delete']]);
    }

    public function index()
    {
        $admins = $this->admins::paginate(5);

        return view('admin.content.admin_list.index', ['admins' => $admins]);
    }

    public function add(){
        $roles = Role::all();
        return view('admin.content.admin_list.add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:255',
                'password' => 'required|confirmed|min:6',
                'phone_number' => 'required|min:9|max:11',
                'linkImg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role' => 'required'
            ]);

            $data = [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'role' => $request->role
            ];

            if ($request->hasFile('linkImg')) {
                $dataFile = array();
                $file = $request->linkImg;
                $fileNameOrigin = $file->getClientOriginalName();
                $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalName();

                $filePath = $request->file('linkImg')->storeAs('public/admin_avatar/' . $request->username, $fileNameHash);
                $dataFile = [
                    'file_name' => $fileNameHash,
                    'file_path' => Storage::url($filePath)
                ];

                if(!empty($dataFile)){
                    $data['linkImg'] = $dataFile['file_name'];
                }
                else{
                    $data['linkImg'] = NULL;
                }
            }

            $admin = $this->admins->create($data);

            $admin->assignRole($request->role);

            DB::commit();

            session()->flash('success', 'Bạn đã thêm thành công.');

            return redirect()->route('admin.adminList.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
    }

    public function edit(int $id)
    {
        $roles = Role::all();

        $admin = $this->admins::find($id);

        return view('admin.content.admin_list.edit', ['roles' => $roles, 'admin' => $admin]);
    }

    public function update($id, Request $request)
    {
        try{
            DB::beginTransaction();

            $admin = $this->admins->find($id);

            $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:255',
                'phone_number' => 'required|min:9|max:11',
                'linkImg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role' => 'required'
            ]);

            $data = [
                'username' => $request->username,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'role' => $request->role
            ];

            if(!empty($request->password)){
                $request->validate([
                    'password' => 'required|confirmed|min:6',
                ]);

                $data['password'] = Hash::make($request->password);
            }

            if ($request->hasFile('linkImg')) {
                $avatar = 'public/admin_avatar/' . $admin->username;

                Storage::deleteDirectory($avatar);

                $dataFile = array();

                $file = $request->linkImg;

                $fileNameOrigin = $file->getClientOriginalName();

                $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalName();

                $filePath = $request->file('linkImg')->storeAs('public/admin_avatar/' . $request->username, $fileNameHash);

                $dataFile = [
                    'file_name' => $fileNameHash,
                    'file_path' => Storage::url($filePath)
                ];

                if(!empty($dataFile)){
                    $data['linkImg'] = $dataFile['file_name'];
                }
                else{
                    $data['linkImg'] = NULL;
                }
            }

            $admin->update($data);

            $admin->syncRoles($request->role);

            DB::commit();

            session()->flash('success', 'Bạn đã cập nhật thành công.');

            return redirect()->route('admin.adminList.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        $admin = $this->admins->find($id);

        $avatar = 'public/admin_avatar/' . $admin->username;

        $admin->delete();

        Storage::deleteDirectory($avatar);

        session()->flash('success', 'Bạn đã xóa thành công.');

        return redirect()->route('admin.adminList.index');
    }
}
