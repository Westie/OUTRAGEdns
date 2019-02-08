<?php


namespace OUTRAGEdns\Database;

use \Silex\Application;
use \Zend\Db\Sql\Sql;


class SqlFactory
{
	public static function createSql(Application $app)
	{
		return new Sql($app["internal.database.adapter"]);
	}
}