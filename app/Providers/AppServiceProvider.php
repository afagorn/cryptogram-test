<?php

namespace App\Providers;

use App\Cards\Service\Tokenizer;
use DateInterval;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(Tokenizer::class, function () {
            $config = Config::get('cryptogram');
            return new Tokenizer(
                Storage::get($config['public_key']),
                Storage::get($config['private_key']),
                new DateInterval('PT' . $config['ttl_interval'] . 'S')
            );
        });
    }
}
