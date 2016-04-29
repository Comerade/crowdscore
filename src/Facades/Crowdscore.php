<?php

namespace DeveloperDynamo\Crowdscore\Facades;

use Illuminate\Support\Facades\Facade;

class Crowdscore extends Facade {

	protected static function getFacadeAccessor() { return 'crowdscore'; }

}