<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Customer;
use App\Models\Form;
use App\Models\FormType;
use App\Models\House;
use App\Models\Land;
use App\Models\News;
use App\Models\NewsType;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Exception;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission=$permission;

        $this->middleware(['auth:admin', 'role:admin|super admin']);

        $this->middleware('permission:permission manager|create permission');

        $this->middleware('permission:permission manager', ['only' => ['index']]);

        $this->middleware('permission:create permission', ['only' => ['add', 'store']]);
    }

    public function index()
    {
        $permissions = $this->permission::paginate(5);

        return view('admin.content.permission.index', ['permissions' => $permissions]);
    }

    public function add(){
        return view('admin.content.permission.add');
    }

    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();

            $this->validate($request, [
                'name' => 'required',
                'guard_name' => 'required'
            ]);

            $this->permission->create([
                'guard_name' => $request->guard_name,
                'name' => $request->name
            ]);
            DB::commit();

            session()->flash('success', 'Bạn đã thêm thành công.');

            return redirect()->route('admin.permission.index');
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }
    }
}
