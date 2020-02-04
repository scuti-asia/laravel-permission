<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Permission;

class RolePermission extends Model
{
    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, "permission_id");
    }

	static public function addIfNotExist($role_code, $permission_code)
	{
        $role = Role::where("code", $role_code)->first();
        if (!$role)
        {
            $role = Role::addIfNotExist($role_code, $role_code);
        }

        $permission = Permission::where("code", $permission_code)->first();
        if (!$permission)
        {
            $permission = Permission::addIfNotExist($permission_code, $permission_code);
        }

        $rp = RolePermission::where("role_id", $role->id)->where("permission_id", $permission->id)->first();
        if (!$rp)
        {
            $rp = new RolePermission;
            $rp->role_id = $role->id;
            $rp->permission_id = $permission->id;
            $rp->save();
        }

        return $rp;
	}
}
