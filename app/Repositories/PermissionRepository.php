<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{

    public function all()
    {
        return Permission::get();
    }

    public function findByCode(string $code)
    {
        return Permission::where('permission_code', $code)->first();
    }


    public function findId(string $attribute, string $value)
    {
        return Permission::when($attribute !== null, function($q) use($attribute, $value){
            switch($attribute){
                case "permission_code":
                    $q->where("permission_code", $value);
                break;

                case "permission_slug":
                    $q->where("permission_slug", $value);
                break;

                default:
                    $q->where("permission_code", $value);
            }
            return $q;
        })
        ->select('id')->first()->id;
    }
}
