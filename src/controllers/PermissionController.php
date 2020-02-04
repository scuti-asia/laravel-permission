<?php

namespace Scuti\DeepPermission\Controllers;

use App\Http\Controllers\Controller;
use Scuti\DeepPermission\Repositories\Repository;
use App\Http\Requests;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Http\Requests\DeepPermission\CreatePermission;

class PermissionController extends Controller
{
    protected $model;
    protected $permissionGroup;

	public function __construct(
	    Permission $permission,
        PermissionGroup $permissionGroup
    ) {
        $this->model = new Repository($permission);
        $this->permissionGroup = new Repository($permissionGroup);

        $this->middleware('auth');
	}

    public function index()
    {
        $permissions = $this->model->paginate();
        $getPermissionGroup = $roles = $this->permissionGroup->all()->pluck('name', 'id');

        return response()
            ->view(
                "scuti.deeppermission.permission.index",
                compact(
                    'permissions',
                    'getPermissionGroup'
                )
            );
    }

    public function create()
    {
        return view("scuti.deeppermission.permission.add");
    }

    public function store(CreatePermission $request)
    {
        $this->model->create($request->validated());

		return redirect(url("permission"))
            ->with('dp_announce', trans('deeppermission.alert.permission.created'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$permission = $this->model->show($id);
        $getPermissionGroup = $this->permissionGroup->all()->pluck('name', 'id');

        return view(
            "scuti.deeppermission.permission.add",
            compact(
                'permission',
                'getPermissionGroup'
            )
        );
    }

    public function update(CreatePermission $request, $id)
    {
        $this->model->update($request->validated(), $id);

		return redirect(url("permission"))
            ->with('dp_announce', trans('deeppermission.alert.permission.updated'));
    }

    public function destroy($id)
    {
    	$this->model->delete($id);

		return redirect(url("permission"))
            ->with('dp_announce', trans('deeppermission.alert.permission.deleted'));
    }
}
