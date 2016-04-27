<?php

namespace DeveloperDynamo\Crowdsource;

use Illuminate\Support\ServiceProvider;

class CrowdsourceProvider extends ServiceProvider
{
    /**
     * Bootstrap the PushNotification services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->publishes([
        	__DIR__.'/config/crowdsource.php' => config_path('crowdsource.php'),
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
    	$this->mergeConfigFrom( __DIR__.'/config/crowdsource.php', 'crowdsource');
    	
    	$this->app['crowdsource'] = $this->app->share(function() {
    		return new Crowdsource();
    	});
    }
}
