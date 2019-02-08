<?php


namespace OUTRAGEdns\Database;

use \Silex\Application;
use \Zend\Db\Adapter\Adapter;


class AdapterFactory
{
	public static function createAdapter(Application $app)
	{
		$config = $app["internal.config"];
		
		return new Adapter([
			"driver" => "Pdo_Mysql",
			"hostname" => $config->database->production->host,
			"port" => $config->database->production->port,
			"database" => $config->database->production->database,
			"username" => $config->database->production->username,
			"password" => $config->database->production->password,
		]);
	}
}