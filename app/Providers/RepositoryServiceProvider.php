<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\WishlistRepositoryInterface;
use App\Repositories\WishlistRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
