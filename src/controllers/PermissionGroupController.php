<?php

namespace Scuti\Permission\Controllers;

use App\Http\Controllers\Controller;
use Scuti\Permission\Repositories\Repository;
use App\Http\Requests;
use App\Models\PermissionGroup;
use App\Http\Requests\Permission\CreatePermissionGroup;

class PermissionGroupController extends Controller
{
    protected $model;

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->model = new Repository($permissionGroup);

        $this->middleware('auth');
	}

    public function index()
    {
        $permissionGroup = $this->model->paginate();

        return response()->view(
            "scuti.permission.permission_group.index",
            compact('permissionGroup')
        );
    }

    public function create()
    {
        return response()->view("scuti.permission.permission_group.add");
    }

    public function store(CreatePermissionGroup $request)
    {
        $this->model->create($request->validated());

		return redirect(url("permission/group"))
            ->with('dp_announce', trans('deeppermission.alert.group.created'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$group = $this->model->show($id);

        return response()
            ->view(
                "scuti.permission.permission_group.add",
                compact('group')
            );
    }

    public function update(CreatePermissionGroup $request, $id)
    {
        $this->model->update($request->validated(), $id);

		return redirect(url("permission/group"))
            ->with('dp_announce', trans('deeppermission.alert.group.updated'));
    }

    public function destroy($id)
    {
        $this->model->delete($id);

		return redirect(url("permission/group"))
            ->with('dp_announce', trans('deeppermission.alert.group.deleted'));
    }
}
