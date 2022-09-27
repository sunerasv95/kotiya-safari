<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreateRequest;
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

        if($request->ajax()){
            return response()->json(["data" => $role ]);
        }
    }

    public function showRole($roleCode)
    {
        dd($roleCode);
    }

    public function createRole()
    {
        //dd('rrr');
        return view('admin.role.create');
    }

    public function editRole($roleCode)
    {
        //dd('rrr');
        return view('admin.role.create');
    }

    public function save(RoleCreateRequest $request)
    {
        
    }

    public function update(RoleCreateRequest $request)
    {
        
    }


}
