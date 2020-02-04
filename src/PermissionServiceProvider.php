<?php

namespace Scuti\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views/role', 'role');
        $this->loadViewsFrom(__DIR__.'/views', 'dp');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/scuti/permission'),
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/models' => base_path('app/Models'),
            __DIR__.'/requests' => base_path('app/Http/Requests/Permission'),
            __DIR__.'/middlewares' => base_path('app/Http/Middleware'),
            __DIR__.'/lang/en/permission.php' => base_path('resources/lang/en/permission.php'),
        ], 'permission');
        $this->loadViewsFrom(__DIR__.'/views', 'dp');
        $this->publishes([

            __DIR__.'/config' => base_path('config'),
        ], 'permission_config');
    }

    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('Scuti\Permission\Controllers\RoleController');
        $this->app->make('Scuti\Permission\Controllers\PermissionGroupController');
        $this->app->make('Scuti\Permission\Controllers\PermissionController');
        $this->app->make('Scuti\Permission\Controllers\UserRoleController');
        $this->app->make('Scuti\Permission\Controllers\RolePermissionController');
        $this->app->make('Scuti\Permission\Controllers\UserPermissionController');
    }
}
