<?php


namespace OUTRAGEdns\Auth;

use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;


class CredentialsControllerProvider implements ControllerProviderInterface
{
	/**
	 *	Called when connecting an app to this controller provider
	 */
	public function connect(Application $app)
	{
		$controllers = $app["controllers_factory"];
		
		$controllers->match("/login/", function(Request $request) {
		});
		
		$controllers->match("/logout/", function(Request $request) {
		});
		
		return $controllers;
	}
}