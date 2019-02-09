<?php


namespace OUTRAGEdns\Response;

use \OUTRAGEdns\Entity\Controller;
use \OUTRAGEdns\User\Content as UserContent;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


class EntityControllerResponse extends ResponseAbstract
{
	/**
	 *	Entity controller response
	 */
	public static function createResponse(Controller $controller, $template = "index.twig", $status = Response::HTTP_OK)
	{
		$context = $controller->app["internal.context"];
		
		# since I might end up standardising the response objects, it's probably a
		# good idea if I decide to populate only this bit if we're actually going to
		# output to HTML via twig!
		if($controller->content)
			$context->content = $controller->content;
		
		if($controller->form)
			$context->form = $controller->form;
		
		$context->user = $controller->user;
		
		# is our user logged in?
		if($controller->app["session"]->get("godmode"))
			$context->users = UserContent::find()->where("active = 1")->order("id ASC")->get("objects");
		
		# then proceed forward, finally...
		return parent::createStandardResponse($controller->app, $controller->request, $template, $status);
	}
}