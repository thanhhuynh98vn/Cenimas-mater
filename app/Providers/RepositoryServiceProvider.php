<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\PostRepository::class, \App\Repositories\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PostRepository::class, \App\Repositories\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RolesRepository::class, \App\Repositories\Eloquents\RolesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PostRepository::class, \App\Repositories\Eloquents\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CategoriesRepository::class, \App\Repositories\Eloquents\CategoriesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CinemasRepository::class, \App\Repositories\Eloquents\CinemasRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CompanysRepository::class, \App\Repositories\Eloquents\CompanysRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RoomRepository::class, \App\Repositories\Eloquents\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\VoteRepository::class, \App\Repositories\Eloquents\VoteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\VoteValueRepository::class, \App\Repositories\Eloquents\VoteValueRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RoomTypeRepository::class, \App\Repositories\Eloquents\RoomTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RoomSettingRepository::class, \App\Repositories\Eloquents\RoomSettingRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\DashboardRepository::class, \App\Repositories\Eloquents\DashboardRepositoryEloquent::class);
        //:end-bindings:
    }
}
