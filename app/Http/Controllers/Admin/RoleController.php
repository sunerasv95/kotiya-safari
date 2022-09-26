<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreateRequest;

class RoleController extends Controller
{
    private $roleService;

    public function __construct()
    {
        //$this->roleService = $roleService;
    }

    public function findAll()
    {
        return view('admin.role.index');
    }

    public function findByCode($roleCode)
    {
        
    }

    public function createRole()
    {
        dd('rrr');
        return view('admin.role.create');
    }

    public function save(RoleCreateRequest $request)
    {
        
    }


}
