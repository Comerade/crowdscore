<?php

namespace DeveloperDynamo\Crowdsource;

use Config;
use GuzzleHttp\Client;

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
	 * HTTP client prepared to call Crowdsource API
	 * 
	 * @var GuzzleHttp\Client
	 */
	protected $client;
	
	/**
	 * Create a new Crowdsource instance.
	 * 
	 */
	public function __construct()
	{
		$this->key = Config::get('crowdsource.key');
		$this->endpoint = Config::get('crowdsource.endpoint');
		
		$this->setClient();
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
	 * @param string $round_ids
	 * @param string $competition_ids
	 * @return array
	 */
	public function teams($round_ids = null, $competition_ids = null)
	{
		$response = $this->client->get('teams', [], [
				'query' => [
						'round_ids' => $round_ids,
						'competition_ids' => $competition_ids,
				]
		]);

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
		$response = $this->client->get('matches', [], [
				'query' => [
						'team_id' => $team_id,
						'round_ids' => $round_ids,
						'competition_id' => $competition_id,
						'from' => $from,
						'to' => $to,
				]
		]);
		
		return $this->getResponse($response);
	}
	
	/**
	 * Retrieve rounds list
	 * 
	 * @param string $competition_ids
	 * @return array
	 */
	public function rounds($competition_ids = null)
	{
		$response = $this->client->get('rounds', [], [
				'query' => [
						'competition_ids' => $competition_ids,
				]
		]);

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