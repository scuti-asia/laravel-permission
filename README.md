# Permission

### Step 1: Install Permission

composer require scuti/permission

### Step 2: Add service provider to config/app.php

```php
//Provider

Scuti\Permission\PermissionServiceProvider::class, 
Maatwebsite\Excel\ExcelServiceProvider::class,
Collective\Html\HtmlServiceProvider::class,

//Fadecade

'Excel' => Maatwebsite\Excel\Facades\Excel::class,
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,

```

### Step 3: Publish vendor

php artisan vendor:publish --tag=permission --force

php artisan migrate

	
```php


use Scuti\Permission\Traits\DPUserModelTrait;

class User extends Authenticatable
{
    use DPUserModelTrait;
}


```
Add this row to Http\Kernel.php in $routeMiddleware

```php

'dppermission' => \App\Http\Middleware\DPPermissionMiddleware::class,
'dprole' => \App\Http\Middleware\DPRoleMiddleware::class,

```

### Step 5 (optional): If you want a user pass all the permission, add SCUTI_DP_ADMIN_ID to your .env file

```bash
SCUTI_DP_ADMIN_ID={{user_id}}
#for example
SCUTI_DP_ADMIN_ID=1

```

### Supported function

```php

//Check role of user
$user->hasRole("role.code");

//Check permission of user (include if user has role which has permission)
$user->hasPermission("permission.code");

//Query with role code
User::withRole("role.code");

//Query with permission code (include user who has role which has permission)
User::withPermission("permission.code");

// Using middleware

middleware("dppermission:admin.read");
middleware("dprole:admin");

```
