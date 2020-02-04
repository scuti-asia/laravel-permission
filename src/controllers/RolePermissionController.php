<?php

namespace Scuti\DeepPermission\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\PermissionGroup;
use Scuti\DeepPermission\Repositories\Repository;

class RolePermissionController extends Controller
{
    protected $model;
    protected $role;

	public function __construct(
        PermissionGroup $permissionGroup,
        Role $role
    ) {
        $this->model = new Repository($permissionGroup);
        $this->role = new Repository($role);

        $this->middleware('auth');
	}

    public function index($role_id)
    {
    	$role = $this->role->show($role_id);
        $permissionGroup = $this->model->paginate();

        return view(
            "scuti.deeppermission.role.permission.index",
            compact(
                'role',
                'permissionGroup'
            )
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $role_id)
    {
    	$role = $this->role->show($role_id);
		if (isset($request->permission_id) && count($request->permission_id))
		{
			$role->permissions()->sync($request->permission_id);
		} else {
			$role->permissions()->sync(array());
		}

		$role->save();

		return redirect(url("/role/$role_id/permission"))
            ->with('dp_announce', trans('deeppermission.alert.role_permission.updated'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
