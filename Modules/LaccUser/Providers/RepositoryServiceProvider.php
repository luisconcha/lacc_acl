<?php
/**
 * File: RepositoryServiceProvider.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 02/03/17
 * Time: 22:16
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
          \LaccUser\Repositories\UserRepository::class,
          \LaccUser\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
          \LaccUser\Repositories\RoleRepository::class,
          \LaccUser\Repositories\RoleRepositoryEloquent::class
        );
        $this->app->bind(
          \LaccUser\Repositories\PermissionRepository::class,
          \LaccUser\Repositories\PermissionRepositoryEloquent::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}