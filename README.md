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

#Call crowdsource API
```
$competitions = Crowdsource::competitions();

var_dump($competitions);
```