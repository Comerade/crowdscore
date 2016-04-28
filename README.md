# Crowdsource live score API client
Laravel package to connect and use Crowdsource API for footbal live score data

#Install
Add follow line into "require" section in your composer.json:

```
"developerdynamo/crowdsource": "1.*"
```

Update composer with command:

```
"composer update"
```

#Configure Laravel 5
Like all providers, put this follow lines in your config/app.php

```
'providers' => [
	...
	DeveloperDynamo\Crowdsource\CrowdsourceProvider::class,
],
```

Add facades in aliases array
```
'aliases' => [
	...
	'Crowdsource' => DeveloperDynamo\Crowdsource\Facades\Crowdsource::class,
],
```

#Publish configuration
Finally you need to generate a configuration file for this package. Run follow composer command:

```
php artisan vendor:publish --provider="DeveloperDynamo\Crowdsource\CrowdsourceProvider"
```

#Put your Crowdsource api key
In `config/crowdsource.php` you can put your crowdsource API KEY used by package to authorize your request.

```
return [
	
	/*
	 * API KEY of your Crowdsourse account
	 */
    "key" => '',
	
	/*
	 * Crowdsourse API v1 endpoint
	 */
	"endpoint" => "https://api.crowdscores.com/api/v1",
	
	/*
	 * Connection timeout 
	 */
	"timeout" => 120,

];
```

#Call crowdsource API
```
use Crowdsource;

$competitions = Crowdsource::competitions();

var_dump($competitions);
```