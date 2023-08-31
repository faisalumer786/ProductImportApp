<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CsvImportService;

class CsvImportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('csv-import', function () {
            return new CsvImportService();
        });
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
