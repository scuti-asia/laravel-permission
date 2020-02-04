<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = ['code', 'name', 'permission_group_id'];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, "permission_group_id");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_id", "permission_id", "role_permissions");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "user_id", "permission_id", "user_permission");
    }

	static public function addIfNotExist($permission_name, $permission_code)
	{
		$permission_component = explode(".", $permission_code);
		$group_code = $permission_component[0];

		$group = PermissionGroup::where("code", $group_code)->first();
		if (!$group)
		{
			$group = PermissionGroup::addIfNotExist($group_code, $group_code);
		}

		$permission = Permission::firstOrNew(array("code" => $permission_code));
		if ($permission_name !== false)
		{
			$permission->name = $permission_name;
		}
		$permission->permission_group_id = $group->id;
		$permission->save();

		return $permission;
	}
}
