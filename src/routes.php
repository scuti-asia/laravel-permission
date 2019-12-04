<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("permission/group", "scuti\deeppermission\controllers\PermissionGroupController");
	Route::resource("permission", "scuti\deeppermission\controllers\PermissionController");
	Route::resource("user_role", "scuti\deeppermission\controllers\UserRoleController");
	Route::resource("user.permission", "scuti\deeppermission\controllers\UserPermissionController");
	Route::resource("role", "scuti\deeppermission\controllers\RoleController");
	Route::resource("role.permission", "scuti\deeppermission\controllers\RolePermissionController");
});
