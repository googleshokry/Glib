<?php

namespace Glib;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Glib\Validations\ValidationsRulesBoot;
use File;
use PhpParser\Node\Scalar\MagicConst\Dir;

/**
 * use  this class to integrate with laravel 5.5
 * User: EngShokry
 * Date: 16/04/18
 * Time: 01:30 م
 */
class GlibServiceProvider extends ServiceProvider
{

    private $migrations = [
        __DIR__ . '/Tag/migrations',
        __DIR__ . '/SEO/migrations',
        __DIR__ . '/Mailer/migrations',
        __DIR__ . '/Models/migrations',
        __DIR__ . '/ContactUs/migrations',
        __DIR__ . '/NewsLetter/migrations',
        __DIR__ . '/FeatureAble/migrations',
        __DIR__ . '/Reviews/migrations',

    ];


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        ValidationsRulesBoot::boot();

        $this->loadViewsFrom(__DIR__ . '/Resource', "Glib");


        foreach (File::directories(__DIR__ . "/Models/Plugins") as $dir)
            $this->migrations[] = $dir . "/Migration";



        $this->loadRoutesFrom(__DIR__ . "/routes.php");


        $this->runLoadMigrations();

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }

    private function runLoadMigrations()
    {
        foreach ($this->migrations as $path)
            $this->loadMigrationsFrom($path);
    }
}
