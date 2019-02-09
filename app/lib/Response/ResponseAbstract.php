<?php


namespace OUTRAGEdns\Response;

use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


class ResponseAbstract extends Response
{
	/**
	 *	Eventually populate our response object
	 */
	protected static function createStandardResponse(Application $app, Request $request, $template = "index.twig", $status = Response::HTTP_OK)
	{
		$context = $app["internal.context"];
		
		# might be useful??
		if(!isset($context->fullwidth))
			$context->fullwidth = false;
		
		$context->request = $request;
		$context->config = $app["internal.config"];
		$context->godmode = $app["session"]->get("godmode");
		
		# at the moment there's no way within symfony to do this sort of thing
		# sadly - hurrah for custom functionality
		$request->url = static::getRequestURL($request);
		
		# and now to render everything
		$output = $app["twig"]->render($template, $context->toArray());
		
		# oh, we might actually want to clean up any notifications
		# that may have been generated
		$app["session"]->set("_notification_messages", []);
		
		# oh, we might want to set our response
		return new Response($output, $status);
	}
	
	
	/**
	 *	Creates an array of paths that we can use in our templates and controllers
	 *	to figure out what route we're wanting to take
	 */
	protected static function getRequestURL(Request $request)
	{
		$list = explode("/", parse_url($request->server->get("REQUEST_URI"), PHP_URL_PATH));
		$list[0] = $request->getScheme()."://".$request->getHttpHost();
		
		if(strlen(end($list)) == 0)
			array_pop($list);
		
		return $list;
	}
}