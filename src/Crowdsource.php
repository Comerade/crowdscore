<?php

namespace DeveloperDynamo\Crowdsource;

use Config;

class Crowdsource
{
	/**
	 * API KEY of your Crowdsourse account
	 * 
	 * @var string
	 */
	protected $key;

	/**
	 * Crowdsourse API endpoint
	 *
	 * @var string
	 */
	protected $endpoint;
	
	/**
	 * Create a new Crowdsource instance.
	 * 
	 */
	public function __construct()
	{
		$this->key = Config::get('crowdsource.key');
		$this->endpoint = Config::get('crowdsource.endpoint');
	}
	
	/**
	 * Retrieve seasons list
	 * 
	 * @return array
	 */
	public function seasons()
	{
		;
	}
}