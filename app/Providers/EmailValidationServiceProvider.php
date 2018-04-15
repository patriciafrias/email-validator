<?php
declare(strict_types=1);

namespace App\Providers;

use EmailValidator\Domain\EmailValidationManager;
use EmailValidator\Infrastructure\Adapter\Doctrine\DoctrineEmailValidationRepositoryAdapter;
use Illuminate\Support\ServiceProvider;

class EmailValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('EmailValidator\Domain\Port\EmailValidationRepositoryInterface', function ($app)
        {
            return new DoctrineEmailValidationRepositoryAdapter($app->make('em'));
        });
        $this->app->bind('EmailValidator\Domain\EmailValidationManager', function ($app) {
            return new EmailValidationManager(new DoctrineEmailValidationRepositoryAdapter($app->make('em')));
        });
    }
}



