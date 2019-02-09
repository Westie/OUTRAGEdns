<?php


namespace OUTRAGEdns\Entity;

use \Silex\Application;
use \Silex\Api\ControllerProviderInterface;


class ControllerProvider implements ControllerProviderInterface
{
	/**
	 *	Called when connecting an app to this controller provider
	 */
	public function connect(Application $app)
	{
		$entities = [];
		$controllers = $app["controllers_factory"];
		
		# force redirect to default page
		$controllers->match("/", function(Application $app) {
			return $app->redirect("/domains/");
		});
		
		# go through and figure out which entities one is allowed to access
		foreach($app["internal.config"]->entities as $entity)
		{
			if(!empty($entity->actions))
			{
				$class = "\\".str_replace(".", "\\", $entity->namespace)."\\Controller";
				
				if(class_exists($class))
					$entities[$class] = $entity;
			}
		}
		
		# now we have a decent list of entities that we can access, we need to
		# go through and create routes for this.
		foreach($entities as $class => $entity)
		{
			$endpoint = "/".($entity->route ?? $entity->type."s");
			$controller = new $class();
			
			$controllers->mount($endpoint, (new ControllerActionProvider($controller, $entity))->connect($app));
		}
		
		return $controllers;
	}
}