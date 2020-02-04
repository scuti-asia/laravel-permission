<?php

namespace Scuti\Permission\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Permission\CreateRole;
use Scuti\Permission\Repositories\Repository;

class RoleController extends Controller
{
    protected $model;

	public function __construct(Role $role)
    {
        $this->model = new Repository($role);

        $this->middleware('auth');
	}

    public function index()
    {
        $roles = $this->model->paginate();

        return response()->view(
            "scuti.permission.role.index",
            compact('roles')
        );
    }

    public function create()
    {
        return response()->view("scuti.permission.role.add");
    }

    public function store(CreateRole $request)
    {
        $this->model->create($request->validated());

		return redirect(url("role"))
            ->with('dp_announce', trans('deeppermission.alert.role.created'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$role = $this->model->show($id);

        return response()->view(
        "scuti.permission.role.add",
            compact('role')
        );
    }

    public function update(CreateRole $request, $id)
    {
        $this->model->update($request->validated(), $id);

		return redirect(url("role"))
            ->with('dp_announce', trans('deeppermission.alert.role.updated'));
    }

    public function destroy($id)
    {
        $this->model->delete($id);

		return redirect(url("role"))
            ->with('dp_announce', trans('deeppermission.alert.role.deleted'));
    }
}
