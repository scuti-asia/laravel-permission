<?php

namespace Scuti\DeepPermission\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Scuti\DeepPermission\Repositories\Repository;

class UserRoleController extends Controller
{
    protected $role;
    protected $user;

    public function __construct(
        Role $role,
        User $user
    ) {
        $this->role = new Repository($role);
        $this->user = new Repository($user);

        $this->middleware('auth');
    }

    public function index()
    {
        $roles = $this->role->all();
        $users = $this->user->paginate();

        return view(
            "scuti.deeppermission.user_role.index",
            compact('roles', 'users')
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
    	foreach (array_keys($_POST) as $key)
		{
			if (strpos($key, "user_check_") === 0)
			{
				$component = explode("_", $key);
				$user_id = $component[2];

				$user = User::find($user_id);
                if (isset($_POST["user_$user->id"]))
                {
    				$user->roles()->sync($_POST["user_$user->id"]);
                }
                else
                {
                    $user->roles()->sync([]);
                }
			}
		}
		return redirect(url("user_role"))->with('dp_announce', trans('deeppermission.alert.user_role.updated'));
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
