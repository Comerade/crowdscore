##Dependencies
This package use Guzzle HTTP client library that you needs to install in your Laravel instance. To perform this add follow line in `require` section in your composer.json 

```json
"guzzlehttp/guzzle": "~6.0",
```

# Crowdscore live score API client
Laravel package to connect and use Crowdscore API for football live score data

#Install
Add follow line into "require" section in your composer.json:

```json
"developerdynamo/crowdscore": "1.*"
```

Update composer with command:

```json
"composer update"
```

#Configure Laravel 5
Like all providers, put this follow lines in your config/app.php

```php
'providers' => [
	...
	DeveloperDynamo\Crowdscore\CrowdscoreProvider::class,
],
```

Add facades in aliases array
```php
'aliases' => [
	...
	'Crowdscore' => DeveloperDynamo\Crowdscore\Facades\Crowdscore::class,
],
```

#Publish configuration
Finally you need to generate a configuration file for this package. Run follow composer command:

```
php artisan vendor:publish --provider="DeveloperDynamo\Crowdscore\CrowdscoreProvider"
```

#Put your Crowdscore api key
In `config/crowdscore.php` you can put your crowdsource API KEY used by package to authorize your requests.

```php
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
```php
use Crowdscore;

$competitions = Crowdscore::competitions();

var_dump($competitions);
```

###Seasons
```php
use Crowdscore;

$seasons = Crowdscore::seasons();

var_dump($seasons);
```

###Teams
```php
use Crowdscore;

$teams = Crowdscore::teams();

var_dump($teams);
```
Teams accept a few parameters as `round_ids` or `competitions_ids`. You can pass the params into `teams()` method:

```php
// Single value
$teams = Crowdscore::teams(2323, 3232);

//Array for multiple values
$teams = Crowdscore::teams([2323, 2324], [3232, 3233]);
```

###Matches
```php
use Crowdscore;

$matches = Crowdscore::matches();

var_dump($matches);
```
Also `/matches` route accept a few params tha you can treat in the same way of `/teams`.
