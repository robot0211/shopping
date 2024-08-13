<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    use DeleteModelTrait;
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->get('perPage', 5); // Default is 5

        $roles = $this->role->when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('display_name', 'like', '%' . $query . '%');
        })->latest()->paginate($perPage);

        return view('admin.role.index', compact('roles', 'query', 'perPage'));
    }

    public function create()
    {
        $permissionParent = $this->permission->where('parent_id', 0)->get();

        return view('admin.role.add', compact('permissionParent'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);

            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function edit($id){
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
       
        return view('admin.role.edit', compact('permissionParent', 'role', 'permissionsChecked'));
    }

    public function update(Request $request, $id){
        try {
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);

            $this->role->find($id)->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($this->role, $id);
    }
}
