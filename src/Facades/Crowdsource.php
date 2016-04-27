<?php

namespace DeveloperDynamo\Crowdsource\Facades;

use Illuminate\Support\Facades\Facade;

class Crowdsource extends Facade {

	protected static function getFacadeAccessor() { return 'crowdsource'; }

}