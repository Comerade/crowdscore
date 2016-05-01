<?php

namespace DeveloperDynamo\Crowdscore;

use Config;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class CrowdscoreProvider extends ServiceProvider
{
    /**
     * Bootstrap the PushNotification services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->publishes([
        	__DIR__.'/config/crowdscore.php' => config_path('crowdscore.php'),
    	], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	/*
    	 * To retrieve configuration width "dot notation" Es: "pushnotification.ios.xxx"
    	 */
    	$this->mergeConfigFrom( __DIR__.'/config/crowdscore.php', 'crowdscore');

    	$this->app['crowdscore'] = $this->app->share(function() {
            $endpoint = Config::get('crowdscore.endpoint');
            $key = Config::get('crowdscore.key');
            $timeout = Config::get('crowdsource.timeout');

            $client = new Client([
                'base_uri'        => $endpoint,
                'connect_timeout' => $timeout,
                'verify'          => false,
                'headers'         => ['x-crowdscores-api-key' => $key],
            ]);

    		return new Crowdscore($client, $key, $endpoint);
    	});
    }
}
