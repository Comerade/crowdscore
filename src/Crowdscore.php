<?php

namespace DeveloperDynamo\Crowdscore;

use Config;
use GuzzleHttp\Client;

class Crowdscore
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
	 * HTTP client prepared to call Crowdscore API
	 * 
	 * @var GuzzleHttp\Client
	 */
	protected $client;
	
	/**
	 * Create a new Crowdscore instance.
	 * 
	 */
	public function __construct()
	{
		$this->key = Config::get('crowdscore.key');
		$this->endpoint = Config::get('crowdscore.endpoint');
		
		$this->setClient();
	}
	
	/**
	 * Retrieve seasons list
	 * 
	 * @return array
	 */
	public function competitions()
	{
		$response = $this->client->request('GET', 'competitions');

		return $this->getResponse($response);
	}
	
	/**
	 * Retrieve seasons list
	 * 
	 * @return array
	 */
	public function seasons()
	{
		$response = $this->client->request('GET', 'seasons');

		return $this->getResponse($response);
	}
	
	/**
	 * Retrieve seasons list
	 * 
	 * @param integer|array $round_ids
	 * @param integer|array $competition_ids
	 * @return array
	 */
	public function teams($round_ids = null, $competition_ids = null)
	{
		if(is_array($round_ids))
			$round_ids = implode(",", $round_ids);

		if(is_array($competition_ids))
			$competition_ids = implode(",", $competition_ids);
		
		$response = $this->client->get('teams?round_ids='.$round_ids.'&competition_ids='.$competition_ids);

		return $this->getResponse($response);
	}
	
	/**
	 * Retrieve matches list
	 * 
	 * @param integer $team_id
	 * @param string $round_ids
	 * @param integer $competition_id
	 * @param date $from
	 * @param date $to
	 * @return array
	 */
	public function matches($team_id = null, $round_ids = null, $competition_id = null, $from = null, $to = null)
	{
		if(is_array($round_ids))
			$round_ids = implode(",", $round_ids);
		
		$response = $this->client->get('matches?team_id='.$team_id.'&round_ids='.$round_ids.'&competition_id='.$competition_id.'&from='.$from.'&to='.$to);
		
		return $this->getResponse($response);
	}
	
	/**
	 * Retrieve rounds list
	 * 
	 * @param integer|array $competition_ids
	 * @return array
	 */
	public function rounds($competition_ids = null)
	{
		if(is_array($competition_ids))
			$competition_ids = implode(",", $competition_ids);
		
		$response = $this->client->get('rounds?competition_ids='.$competition_ids);

		return $this->getResponse($response);
	}
	
	/**
	 * Create and configure HTTP client for Crowdsource API
	 */
	protected function setClient()
	{
		$this->client = new Client([
				'base_uri' => $this->endpoint,
				'connect_timeout' => Config::get('crowdsource.timeout'),
				'verify' => false,
				'headers' => ['x-crowdscores-api-key' => $this->key],
		]);
	}
	
	/**
	 * Get array from json response
	 * 
	 * @param $response
	 * @return array
	 */
	protected function getResponse($response)
	{
		return json_decode($response->getBody(), true);
	}
}