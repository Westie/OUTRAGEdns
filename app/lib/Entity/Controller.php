<?php


namespace OUTRAGEdns\Entity;

use \OUTRAGEdns\Configuration\Configuration;
use \OUTRAGElib\Delegator\DelegatorTrait;
use \Silex\Application;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;


class Controller
{
	/**
	 *	What is the request?
	 */
	public $request = null;
	
	
	/**
	 *	What is the response?
	 */
	public $response = null;
	
	
	/**
	 *	What is the user that is logged in?
	 */
	public $user = null;
	
	
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
		$this->user = $this->app["user"];
		
		return null;
	}
	
	
	/**
	 *	Can a user perform an action?
	 */
	public function allowed($action)
	{
		return true;
	}
}