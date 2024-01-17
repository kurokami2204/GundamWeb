<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Exception;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role=$role;
        $this->middleware(['auth:admin', 'role:admin|super admin']);

        $this->middleware('permission:role manager|create role|change role permission');

        $this->middleware('permission:role manager', ['only' => ['index']]);

        $this->middleware('permission:create role', ['only' => ['add', 'store']]);

        $this->middleware('permission:change role permission', ['only' => ['removePermission', 'updateMultiplePermissions']]);

    }

    public function index()
    {
        $roles = $this->role::with('permissions')->first()->paginate(5);

        $all_permissions = Permission::all();

        return view('admin.content.role.index', ['roles' => $roles, 'all_permissions' => $all_permissions]);
    }

    public function add()
    {
        $permissions = Permission::all();

        return view('admin.content.role.add', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $this->validate($request, [
                'name' => 'required',
                'guard_name' => 'required'
            ]);

            $role = $this->role->create([
                'guard_name' => $request->guard_name,
                'name' => $request->name
            ]);

            if($request->has('permission'))
            {
                foreach($request->permission as $permission)
                {
                    $existed_permission = Permission::find($permission);

                    $role->givePermissionTo($existed_permission);

                    $role->forgetCachedPermissions();

                    $role->load('permissions');
                }
            }

            DB::commit();

            session()->flash('success', 'Bạn đã thêm thành công.');

            return redirect()->route('admin.role.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();

            session()->flash('failed', 'Bạn đã thêm thất bại.');

            return redirect()->route('admin.role.index');
        }
    }

    public function removePermission($id_role, $id_permission)
    {
        try{
            DB::beginTransaction();

            $role = $this->role::with('permissions')->find($id_role);

            $role->permissions()->detach($id_permission);

            $role->forgetCachedPermissions();

            $role->load('permissions');

            DB::commit();

            session()->flash('success', 'Bạn đã cập nhật thành công.');

            return redirect()->route('admin.role.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();

            session()->flash('failed', 'Bạn đã cập nhật thất bại.');

            return redirect()->route('admin.role.index');
        }
    }

    public function updateMultiplePermissions(Request $request, $id_role)
    {
        try{
            $role = $this->role::with('permissions')->find($id_role);

            $existed_permission = $role->permissions;

            $request_permission = collect();

            if($request->has('add_permission'))
            {
                foreach($request->add_permission as $permission)
                {
                    $roles_with_existed_permission = $role->permissions->find($permission);

                    if((isset($roles_with_existed_permission))){
                        $request_permission[] = $roles_with_existed_permission;
                    }
                    else
                    {
                        $add_if_not_exist_permission = Permission::find($permission);

                        $role->givePermissionTo($add_if_not_exist_permission);

                        $role->forgetCachedPermissions();

                        $role->load('permissions');
                    }
                }
            }
            $diff = $existed_permission->diff($request_permission);

            foreach($diff as $permission)
            {
                $role->permissions()->detach($permission->id);

                $role->forgetCachedPermissions();

                $role->load('permissions');
            }

            DB::commit();

            session()->flash('success', 'Bạn đã cập nhật thành công.');

            return redirect()->route('admin.role.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();

            session()->flash('failed', 'Bạn đã cập nhật thất bại.');

            return redirect()->route('admin.role.index');
        }
    }
}
