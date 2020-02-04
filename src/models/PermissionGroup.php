<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
	protected $fillable = ['name', 'code'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, "permission_group_id");
    }

	static public function addIfNotExist($group_name, $group_code)
	{
		$group = Permission_group::firstOrNew(array("code" => $group_code));
		$group->name = $group_name;
		$group->save();

		return $group;
	}
}
