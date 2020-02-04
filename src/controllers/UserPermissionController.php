<?php

namespace Scuti\Permission\Controllers;

use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\User;
use Scuti\Permission\Repositories\Repository;

class UserPermissionController extends Controller
{
    protected $permissionGroup;
    protected $user;

    public function __construct(
        PermissionGroup $permissionGroup,
        User $user
    ) {
        $this->permissionGroup = new Repository($permissionGroup);
        $this->user = new Repository($user);

        $this->middleware('auth');
    }

    public function index($user_id)
    {
        $user = $this->user->show($user_id);
        $permissionGroup = $this->permissionGroup->all();

		return view(
		    "scuti.permission.user.permission.index",
            compact('user', 'permissionGroup')
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $user_id)
    {
    	$user = $this->user->show($user_id);

		if (isset($request->permission_id) && count($request->permission_id))
		{
			$user->permissions()->sync($request->permission_id);
		}
		else
		{
			$user->permissions()->sync(array());
		}
		$user->save();

		return redirect(url("/user/$user_id/permission"))
            ->with('dp_announce', trans('deeppermission.alert.user_permission.updated'));
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
