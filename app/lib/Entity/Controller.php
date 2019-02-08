<?php


namespace OUTRAGEdns\Entity;

use \OUTRAGEdns\Configuration\Configuration;
use \OUTRAGEdns\User\Content as UserContent;
use \OUTRAGElib\Delegator\DelegatorTrait;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


class Controller
{
	/**
	 *	What is the request?
	 */
	protected $request = null;
	
	
	/**
	 *	What is the response?
	 */
	protected $response = null;
	
	
	/**
	 *	What is the user that is logged in?
	 */
	protected $user = null;
	
	
	/**
	 *	Add in required traits
	 */
	use ApplicationDelegatorTrait;
	use ControllerDelegatorTrait;
	use DelegatorTrait;
	use EntityDelegatorTrait;
	
	
	/**
	 *	This method is called before the path is executed - this can be used to prepare
	 *	stuff like content before it's time for stuff to be performed on it.
	 */
	public function init(Request $request)
	{
		$this->request = $request;
		$this->response = $this->app["internal.context"];
		
		# is our user logged in?
		$this->user = new UserContent();
		
		if($session = $this->request->getSession())
		{
			if($session->has("authenticated_users_id"))
				$this->user->load($session->get("authenticated_users_id"));
		}
		
		return null;
	}
	
	
	/**
	 *	Can a user perform an action?
	 */
	public function allowed($action)
	{
		return true;
	}
	
	
	/**
	 *	Tell Silex to output this request as a HTML request, using the standard umbrella object
	 *	as a source of data
	 */
	protected function toHTML($template = "index.twig")
	{
		# at the moment there's no way within symfony to do this sort of thing
		# sadly - hurrah for custom functionality
		$this->request->url = $this->getRequestURL($this->request);
		
		# since I might end up standardising the response objects, it's probably a
		# good idea if I decide to populate only this bit if we're actually going to
		# output to HTML via twig!
		$context = $this->app["internal.context"];
		
		if(!isset($context->fullwidth))
			$context->fullwidth = false;
		
		$context->request = $this->request;
		
		if($this->content)
			$context->content = $this->content;
		
		if($this->form)
			$context->form = $this->form;
		
		$context->config = $this->app["internal.config"];
		$context->godmode = $this->app["internal.godmode"];
		$context->user = $this->user;
		
		# is our user logged in?
		if($session = $this->request->getSession())
		{
			if($context->godmode)
				$context->users = UserContent::find()->where("active = 1")->order("id ASC")->get("objects");
		}
		
		# and now to render everything
		$output = $this->app["twig"]->render($template, $context->toArray());
		
		# oh, we might actually want to clean up any notifications
		# that may have been generated
		$session->set("_notification_messages", []);
		
		# oh, we might want to set our response
		$response = new Response();
		
		$response->setContent($output);
		$response->setStatusCode(Response::HTTP_OK);
		
		return $response;
	}
	
	
	/**
	 *	Creates an array of paths that we can use in our templates and controllers
	 *	to figure out what route we're wanting to take
	 */
	protected function getRequestURL(Request $request)
	{
		$list = explode("/", parse_url($request->server->get("REQUEST_URI"), PHP_URL_PATH));
		$list[0] = $request->getScheme()."://".$request->getHttpHost();
		
		if(strlen(end($list)) == 0)
			array_pop($list);
		
		return $list;
	}
}
