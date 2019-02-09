<?php


namespace OUTRAGEdns\Entity;

use \OUTRAGEdns\Configuration\Configuration;
use \OUTRAGEdns\Entity\Controller;
use \Silex\Api\ControllerProviderInterface;
use \Silex\Application;


class ControllerActionProvider implements ControllerProviderInterface
{
	/**
	 *	Store controller
	 */
	protected $controller = null;
	
	
	/**
	 *	Store entity
	 */
	protected $entity = null;
	
	
	/**
	 *	Construct entity action
	 */
	public function __construct(Controller $controller, Configuration $entity)
	{
		$this->controller = $controller;
		$this->entity = $entity;
	}
	
	
	/**
	 *	Called when connecting an app to this controller provider
	 */
	public function connect(Application $app)
	{
		$controllers = $app["controllers_factory"];
		
		foreach($this->entity->actions as $action => $settings)
		{
			# define main route
			$route = "/".$action."/";
			
			if($settings->id)
				$route .= "{id}/";
			
			$controllers->match($route, [ $this->controller, $action ])->before([ $this->controller, "init" ]);
			
			# define grid view route
			if(!empty($settings->default) && empty($settings->id))
				$controllers->match("/", [ $this->controller, $action ])->before([ $this->controller, "init" ]);
		}
		
		return $controllers;
	}
}