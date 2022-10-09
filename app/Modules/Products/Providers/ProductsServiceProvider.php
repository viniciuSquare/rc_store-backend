<?php

namespace App\Modules\Products\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Inclui as migrations referenciadas na fila de execução
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Inclui as rotas referenciadas na aplicação
        // Podendo incluir middlewares, prefixos e namespaces para o controller
        Route::middleware(['api'])
            ->prefix('api/products')
            ->namespace('App\Modules\Products\Http\Controllers')
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
