<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("permission/group", "scuti\permission\controllers\PermissionGroupController");
	Route::resource("permission", "scuti\permission\controllers\PermissionController");
	Route::resource("user_role", "scuti\permission\controllers\UserRoleController");
	Route::resource("user.permission", "scuti\permission\controllers\UserPermissionController");
	Route::resource("role", "scuti\permission\controllers\RoleController");
	Route::resource("role.permission", "scuti\permission\controllers\RolePermissionController");
});
