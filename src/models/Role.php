<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'code'];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "role_permissions", "role_id", "permission_id");
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "user_roles", "role_id", "user_id");
    }

	static public function addIfNotExist($role_name, $role_code)
	{
		$group = Role::firstOrNew(array("code" => $role_code));
		if ($role_name !== false)
		{
			$group->name = $role_name;
		}
		$group->save();

		return $group;
	}
}
