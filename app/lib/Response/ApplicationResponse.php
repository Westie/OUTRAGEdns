<?php


namespace OUTRAGEdns\Response;

use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


class ApplicationResponse extends ResponseAbstract
{
	/**
	 *	Application response
	 */
	public static function createResponse(Application $app, Request $request, $template = "index.twig", $status = Response::HTTP_OK)
	{
		return parent::createStandardResponse($app, $request, $template, $status);
	}
}