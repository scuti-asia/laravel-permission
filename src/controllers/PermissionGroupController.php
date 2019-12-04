<?php

namespace Scuti\DeepPermission\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PermissionGroup;
use App\Http\Requests\DeepPermission\CreatePermissionGroup;

class PermissionGroupController extends Controller
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
        $permissionGroup = PermissionGroup::with("permissions")->paginate(30);

        return view(
            "scutiltd.deeppermission.permission_group.index",
            compact('permissionGroup')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("scutiltd.deeppermission.permission_group.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionGroup $request)
    {
        $group = new PermissionGroup;
		$group->name = $request->name;
		$group->code = $request->code;
		$group->save();

		return redirect(url("permission/group"))->with('dp_announce', trans('deeppermission.alert.group.created'));
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
    	$group = PermissionGroup::findOrFail($id);
        return view("scutiltd.deeppermission.permission_group.add", array("group" => $group));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePermissionGroup $request, $id)
    {
        $group = PermissionGroup::findOrFail($id);
		$group->name = $request->name;
		$group->code = $request->code;
		$group->save();

		return redirect(url("permission/group"))->with('dp_announce', trans('deeppermission.alert.group.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$group = PermissionGroup::findOrFail($id);
		$group->delete();

		return redirect(url("permission/group"))->with('dp_announce', trans('deeppermission.alert.group.deleted'));
    }
}
