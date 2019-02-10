<?php


namespace OUTRAGEdns\Api;

use \Exception;
use \GuzzleHttp\Client as HttpClient;
use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Request;


class ControllerProvider implements ControllerProviderInterface
{
	/**
	 *	Called when connecting an app to this controller provider
	 */
	public function connect(Application $app)
	{
		$controllers = $app["controllers_factory"];
		$controllers->match("v1/{url}", [ $this, "matchVersion1" ])->assert("url", ".*");
		
		return $controllers;
	}
	
	
	/**
	 *	Dealing with requests to Version 1 API
	 */
	public function matchVersion1(Application $app, Request $request, $url)
	{
		if(empty($app["internal.config"]->{"web-api"}))
			throw new Exception("API configuration is not defined");
		
		if(empty($app["internal.config"]->{"web-api"}->enabled))
			throw new Exception("API is not enabled");
		
		# init request
		$config = $app["internal.config"]->{"web-api"};
		
		$client = new HttpClient([
			"base_uri" => $config->{"base-uri"},
			"headers" => [
				"X-API-Key" => $config->key,
			],
		]);
		
		# what headers are we keeping
		$passthrough_headers = [
			"Access-Control-Allow-Origin",
			"Content-Type",
			"Server",
			"X-Permitted-Cross-Domain-Policies",
		];
		
		# deal with it
		$response = $client->request($request->getMethod(), "/api/v1/".$url);
		$document = json_decode($response->getBody());
		$status = $response->getStatusCode();
		$headers = array_intersect_key($response->getHeaders(), array_flip($passthrough_headers));
		
		return new JsonResponse($document, $status, $headers);
	}
}