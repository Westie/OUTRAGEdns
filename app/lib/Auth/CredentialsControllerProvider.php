<?php


namespace OUTRAGEdns\Auth;

use \Exception;
use \OUTRAGEdns\Response\ApplicationResponse;
use \OUTRAGEdns\User\Content as UserContent;
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
		
		# login
		$controllers->match("/login/", function(Request $request) use ($app)
		{
			$context = $app["internal.context"];
			
			$context->fullwidth = true;
			$context->content = new UserContent();
			
			return ApplicationResponse::createResponse($app, $request);
		});
		
		# god mode
		$controllers->match("/admin/on/", function(Request $request) use ($app)
		{
			if(!$app['security.authorization_checker']->isGranted('ROLE_ADMIN'))
				throw new Exception("Authentication issue");
			
			$app["session"]->set("godmode", true);
			
			return $app->redirect($_SERVER["HTTP_REFERER"] ?: "/");
		});
		
		$controllers->match("/admin/off/", function(Request $request) use ($app)
		{
			$app["session"]->remove("godmode");
			
			return $app->redirect($_SERVER["HTTP_REFERER"] ?: "/");
		});
		
		return $controllers;
	}
}