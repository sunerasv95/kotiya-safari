<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Services\Contracts\RoleServiceInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleService;

    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

    public function findAll()
    {
        $data = [];

        $roles = $this->roleService->getAllRoles();

        $data = compact('roles');
        return view('admin.role.index', $data);
    }

    public function getRole(Request $request, $roleCode)
    {
        $role = $this->roleService->getRoleByCode($roleCode);

        if ($request->ajax()) {
            return response()->json(["data" => $role]);
        }
    }

    public function createRole()
    {
        $data = [];

        $permissions = $this->roleService->getAllPermissions();
        
        $data = compact('permissions');
        return view('admin.role.create', $data);
    }

    public function editRole($roleCode)
    {
        $data = [];

        $role = $this->roleService->getRoleByCode($roleCode);
        $permissions = $this->roleService->getAllPermissions();
        
        $data = compact('permissions', 'role');
        //dd($data);
        return view('admin.role.edit', $data);
    }

    public function save(RoleCreateRequest $request)
    {
        $validated = $request->validated();

        $result = $this->roleService->saveRole($validated);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()->route('admin.roles')->with("successMsg", $result['message']);
        }
    }

    public function update(RoleUpdateRequest $request)
    {
        //dd($request->all());
        $validated = $request->validated();

        $roleCode = $validated['role_code'];

        $result = $this->roleService->updateRole($roleCode, $validated);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()->route('admin.roles')->with("successMsg", $result['message']);
        }
    }
}
