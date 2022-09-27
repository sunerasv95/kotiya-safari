<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::get();
    }

    public function findByCode(string $code, $with = [])
    {
        return Role::where('role_code', $code)
            ->when(!empty($with), function($q) use($with) {
                return $q->with($with);
            })
            ->first();
    }

    public function findId(string $attribute, string $value)
    {
        return Role::when($attribute !== null, function($q) use($attribute, $value){
            switch($attribute){
                case "role_code":
                    $q->where("role_code", $value);
                break;

                case "role_name":
                    $q->where("role_name", $value);
                break;

                default:
                    $q->where("role_code", $value);
            }
            return $q;
        })
        ->select('id')->first()->id;
    }

    public function save(array $roleData= [])
    {
        $role = new Role();

        $role->role_name            = $roleData['role_name'];;
        $role->role_code            = $roleData['role_code'];
        $role->status               = 1;
        $role->created_at           = now();
        $role->updated_at           = now();

        $role->save();

        return $role;
    }

    public function update(Role $role, array $updateData = [])
    {
        return $role->update([
            "role" => $updateData['name'],
            "email" => $updateData['email'],
            "username" => $updateData['username'],
            "role_id" => $updateData['role_id']
        ]);
    }

    public function disable(Role $role)
    {
        $role->status = 0;
        return $role->save();
    }

    public function enable(Role $role)
    {
        $role->status = 1;
        return $role->save();
    }

}
