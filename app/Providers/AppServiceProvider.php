<?php
namespace LACC\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ( $this->app->environment() !== 'production' ) {
            $this->app->register( \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class );
        }

        if ( $this->app->singleton( FakerGenerator::class, function (){
            return FakerFactory::create( 'pt_BR' );
        } ) );
    }
}
