<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Initialize a blade directive to use @role('roleName') in blade view
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRoles({$role})): ?>";
        });
        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });

        // Initialize a blade directive to use @can('permission->slug') in blade view
        Permission::all()->map(function ($permission){
            Gate::define($permission->slug, function ($user) use ($permission){
                return $user->hasPermissionTo($permission);
            });
        });
    }
}
