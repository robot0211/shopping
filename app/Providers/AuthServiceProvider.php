<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Admin
        // Category
        Gate::define('category-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-category'));
        });

        Gate::define('category-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-category'));
        });

        Gate::define('category-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-category'));
        });

        Gate::define('category-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-category'));
        });

        // Menu
        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-menu'));
        });

        Gate::define('menu-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-menu'));
        });

        Gate::define('menu-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-menu'));
        });

        Gate::define('menu-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-menu'));
        });

        // Slider
        Gate::define('slider-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-slider'));
        });

        Gate::define('slider-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-slider'));
        });

        Gate::define('slider-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-slider'));
        });

        Gate::define('slider-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-slider'));
        });

        // Product
        Gate::define('product-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-product'));
        });

        Gate::define('product-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-product'));
        });

        Gate::define('product-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-product'));
        });

        Gate::define('product-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-product'));
        });

        // Setting
        Gate::define('setting-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-setting'));
        });

        Gate::define('setting-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-setting'));
        });

        Gate::define('setting-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-setting'));
        });

        Gate::define('setting-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-setting'));
        });

        // User
        Gate::define('user-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-user'));
        });

        Gate::define('user-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-user'));
        });

        Gate::define('user-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-user'));
        });

        Gate::define('user-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-user'));
        });

        // Role
        Gate::define('role-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-role'));
        });

        Gate::define('role-add', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.add-role'));
        });

        Gate::define('role-edit', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.edit-role'));
        });

        Gate::define('role-delete', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.delete-role'));
        });

        // User
        Gate::define('customer-list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list-customer'));
        });
    }
}
