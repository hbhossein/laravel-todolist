<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Permission::get()->map(function($permission) {
                Gate::define($permission->name, fn ($user) => $user->hasPermissionTo($permission));
            });

            Gate::define('edit', fn ($user, $task) => $user->id == $task->user_id || Gate::allows('edit-task')); 
            
        } catch (\Exception $e) {
            report($e);
            return false;
        }

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });
    }
}
