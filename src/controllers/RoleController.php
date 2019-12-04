<?php

namespace Scuti\DeepPermission\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Role;
use App\Http\Requests\DeepPermission\CreateRole;

class RoleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(30);

        return view("scutiltd.deeppermission.role.index", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("scutiltd.deeppermission.role.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRole $request)
    {
    	 $this->validate($request, array(
	        'name' => 'required|unique:roles',
	        'code' => 'required|unique:roles',
	    ));
        $role = Role::create($request->validated());

		return redirect(url("role"))->with('dp_announce', trans('deeppermission.alert.role.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$role = Role::findOrFail($id);
        return view("scutiltd.deeppermission.role.add", array("role" => $role));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRole $request, $id)
    {
        $role = Role::findOrFail($id);
		$role->update($request->validated());

		return redirect(url("role"))->with('dp_announce', trans('deeppermission.alert.role.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$role = Role::findOrFail($id);
		$role->delete();

		return redirect(url("role"))->with('dp_announce', trans('deeppermission.alert.role.deleted'));
    }
}
