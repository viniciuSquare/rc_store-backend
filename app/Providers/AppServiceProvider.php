<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $modules = [
        'Products'  => 'Products',
        'Movements' => 'Movements',
        // 'Stocks'    => 'Stocks',
        // 'Suppliers' => 'Suppliers'
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->modules as $folder_name => $provider_name) {
            $this->app->register("App\Modules\\{$folder_name}\Providers\\{$provider_name}ServiceProvider");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'ptb');

        $this->app->bind('path.public', function () {
            return base_path() . '/public';
        });

        if (env('DB_LOG') === true) {
            DB::listen(function($query) {
                Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
        }
    }
}
