##Dependencies
This package use Guzzle HTTP client library that you needs to install in your Laravel instance. To perform this add follow line in `require` section in your composer.json 

```
"guzzlehttp/guzzle": "~6.0",
```

# Crowdscore live score API client
Laravel package to connect and use Crowdscore API for football live score data

#Install
Add follow line into "require" section in your composer.json:

```
"developerdynamo/crowdscore": "1.*"
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
	DeveloperDynamo\Crowdscore\CrowdsourceProvider::class,
],
```

Add facades in aliases array
```
'aliases' => [
	...
	'Crowdscore' => DeveloperDynamo\Crowdscore\Facades\Crowdscore::class,
],
```

#Publish configuration
Finally you need to generate a configuration file for this package. Run follow composer command:

```
php artisan vendor:publish --provider="DeveloperDynamo\Crowdsource\CrowdsourceProvider"
```

#Put your Crowdsource api key
In `config/crowdsource.php` you can put your crowdsource API KEY used by package to authorize your requests.

```
return [
	
	/*
	 * API KEY of your Crowdscore account
	 */
    "key" => '',
	
	/*
	 * Crowdscore API v1 endpoint
	 */
	"endpoint" => "https://api.crowdscores.com/api/v1",
	
	/*
	 * Connection timeout 
	 */
	"timeout" => 120,

];
```

#Call Crowdscore API

###Competitions
```
use Crowdscore;

$competitions = Crowdscore::competitions();

var_dump($competitions);
```

###Seasons
```
use Crowdscore;

$seasons = Crowdscore::seasons();

var_dump($seasons);
```

###Teams
```
use Crowdscore;

$teams = Crowdscore::teams();

var_dump($teams);
```
Teams accept a few parameters as `round_ids` or `competitions_ids`. You can pass the params into `teams()` method:

```
// Single value
$teams = Crowdscore::teams(2323, 3232);

//Array for multiple values
$teams = Crowdscore::teams([2323, 2324], [3232, 3233]);
```

###Matches
```
use Crowdscore;

$matches = Crowdscore::matches();

var_dump($matches);
```
Also `/matches` route accept a few params tha you can treat in the same way of `/teams`.
