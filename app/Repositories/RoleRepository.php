<?php

namespace App\Repositories;

use App\Models\Permission;
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

    public function findBySlug(string $slug, $with = [])
    {
        return Role::where('role_slug', $slug)
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
        $role->role_slug            = $roleData['role_slug'];
        $role->status               = $roleData['role_status'];
        $role->level                = 2;
        $role->created_at           = now();
        $role->updated_at           = now();

        $role->save();

        $permissionIds = array_map(function($i){
            return Permission::where('permission_code', $i)->first()->id;
        }, $roleData['role_permissions']);

        $role->permissions()->attach($permissionIds, ['created_at' => now(), "updated_at" => now()]);
        return $role;
    }

    public function update(Role $role, array $updateData = [])
    {
        $updated = false;

        if(isset($updateData['role_name'])){
            $role->role_name = $updateData['role_name'];
            $role->role_slug = $updateData['role_slug'];

            $role->save();
            $updated = true;
        }   
       
        if(!empty($updateData['role_permissions'])){
            $permissionIds = array_map(function($i){
                return Permission::where('permission_code', $i)->first()->id;
            }, $updateData['role_permissions']);

            $role->permissions()->sync($permissionIds, ["updated_at" => now()]);
            $updated = true;
        }   

        return $updated;
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
