<?php

namespace App\Providers;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\LocationRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentLocationRepository;
use App\Repositories\EloquentProductRepository;
use App\Repostiories\Contracts\UserRepositoryInterface;
use App\Repostiories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            EloquentCompanyRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
          LocationRepositoryInterface::class,
          EloquentLocationRepository::class
        );
    }
}
