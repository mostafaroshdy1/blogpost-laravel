<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\EloquentRepository;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Model;
use App\Services\PostService;
use App\Http\Controllers\PostController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(RepositoryInterface::class, PostRepository::class);

        // $this->app->bind(PostService::class, function ($app) {
        //     return new PostService($app->make(PostRepository::class));
        // });


        // $this->app->bind(Model::class, EloquentRepository::class);
        // $this->app->bind(RepositoryInterface::class, EloquentRepository::class);
        // $this->app->bind(RepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
