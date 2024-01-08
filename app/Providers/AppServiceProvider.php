<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Repositories\AutorRepository;
use App\Http\Repositories\Interfaces\AutorRepositoryInterface;

use App\Http\Repositories\AssuntoRepository;
use App\Http\Repositories\Interfaces\AssuntoRepositoryInterface;

use App\Http\Repositories\LivroRepository;
use App\Http\Repositories\Interfaces\LivroRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AutorRepositoryInterface::class, AutorRepository::class);
        $this->app->bind(AssuntoRepositoryInterface::class, AssuntoRepository::class);
        $this->app->bind(LivroRepositoryInterface::class, LivroRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
