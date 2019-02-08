<?php


namespace OUTRAGEdns\Entity;

use \OUTRAGEdns\Configuration\Configuration;
use \OUTRAGEdns\Database\Connection;
use \ReflectionObject;


trait ApplicationDelegatorTrait
{
	/**
	 *	Return the application object
	 *
	 *	This at the moment is stupid, but hey, it's done this way so that I don't have
	 *	to literally rewrite everything else to work :(
	 */
	protected function getter_app()
	{
		return $this->app = $GLOBALS["app"];
	}
	
	
	/**
	 *	Return the config object.
	 */
	protected function getter_config()
	{
		return $this->config = $this->app["internal.config"];
	}
	
	
	/**
	 *	Accessing the database...
	 */
	protected function getter_db()
	{
		return $this->db = $this->app["internal.database.sql"];
	}
}