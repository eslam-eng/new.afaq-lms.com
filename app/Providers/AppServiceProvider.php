<?php

namespace App\Providers;

use App\Models\ContentCategory;
use App\Models\LookupType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        ini_set('memory_limit', '-1');
        ini_set('max_connections', '-1');
	$file = app_path('helpers.php');
        if (file_exists($file)) {
            require_once($file);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Schema::enableForeignKeyConstraints();
        if (Schema::hasTable('lookup_types'))
            View::share('lookup_types', LookupType::get());

        if (Schema::hasTable('content_categories'))
            View::share('content_categories', ContentCategory::with('contents')->get());
        Schema::disableForeignKeyConstraints();
    }
}
