<?php
/**
 *	The beginning of the end for all OUTRAGEweb requests.
 */


if(!class_exists("\OUTRAGEweb\Construct\Autoloader", false))
	require $_SERVER["DOCUMENT_ROOT"]."/app/lib/OUTRAGEweb/Construct/Autoloader.php";


# bootstrap the autoloader and load the config - crucial for pretty much
# everything in the system
\OUTRAGEweb\Construct\Autoloader::register();

$cache = \OUTRAGEweb\Cache\File::getInstance();
$configuration = \OUTRAGEweb\Configuration\Wallet::getInstance();

if(getenv("WWW_DIR"))
{
	define("WWW_DIR", getenv("WWW_DIR"));
} else
{
	define("WWW_DIR", $_SERVER["DOCUMENT_ROOT"]);
}

if(getenv("APP_DIR"))
{
        define("APP_DIR", getenv("APP_DIR"));
} else
{
        define("APP_DIR", WWW_DIR . "/app");
}

if($cache->test("__main_config"))
{
	$configuration->populateContainerRecursively($cache->load("__main_config"));
}
else
{
	$configuration->load(APP_DIR."/etc/config/*.json");
	$configuration->load(APP_DIR."/etc/config/entities/*.json");
	
	$cache->save("__main_config", $configuration->toArray());
}

session_start();


# it's also a good idea to register the Twig autoloader, and other settings
# related to Twig, almost the world's best template engine
if(!class_exists("\Twig_Environment", false))
	require APP_DIR."/lib/Twig/Autoloader.php";


# perhaps it's a good idea to init our request environment, we don't need to
# do anything else here as default functionality is handled by the getters
$environment = new \OUTRAGEweb\Request\Environment();


# and now, what we need to do is find out what path we need to go down.
# should I make this cleaner or should I just stick to doing things the
# new fashioned way?
$router = new \OUTRAGEweb\Request\Router();

if($environment->session->current_users_id)
{
	foreach($configuration->entities as $entity)
	{
		if(!$entity->actions)
			continue;
		
		$class = "\\".str_replace(".", "\\", $entity->namespace)."\\Controller";
		
		if(!class_exists($class))
			continue;
		
		$controller = new $class();
		$endpoint = $entity->route ?: $entity->type."s";
		
		foreach($entity->actions as $action => $settings)
		{
			$route = $settings->global ? ("/".$action."/") : ("/".$endpoint."/".$action."/");
			
			if($settings->id)
				$route .= ":id/";
			
			if(!class_exists($class))
				continue;
			
			$router->register($route, [ $controller, $action ]);
			
			if($settings->default)
				$router->register("/".$endpoint."/", $route);
		}
	}
	
	$router->register("/logout/", [ new \OUTRAGEdns\User\Controller(), "logout" ]);
}
else
{
	$router->register("/login/", [ new \OUTRAGEdns\User\Controller(), "login" ]);
	
	$router->failure(function()
	{
		header("Location: /login/");
		exit;
	});
}


# run our router!
$router->invoke($environment);
exit;
