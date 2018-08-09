<?php
/**
 * Created by PhpStorm.
 * User: yedin
 * Date: 9.8.2018
 * Time: 21:19
 */

namespace yedincisenol\VideoIntelligence;

use Google\Cloud\VideoIntelligence\V1\VideoIntelligenceServiceClient;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('videointelligence.php'),
        ], 'vision');
        $this->mergeConfigFrom(
            __DIR__ . '/config.php', 'videointelligence'
        );
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VideoIntelligence::class, function ($app) {
            return new VideoIntelligenceServiceClient([
                'credentials'   =>  json_decode(file_get_contents($app['config']['vision']['credentials_path']), true)
            ]);
        });

        $this->app->alias(VideoIntelligence::class, 'VideoIntelligence');

    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'VideoIntelligence'
        ];
    }
}