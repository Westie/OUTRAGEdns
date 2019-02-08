<?php


namespace OUTRAGEdns\Configuration;

use \Symfony\Component\Yaml\Exception\ParseException;
use \Symfony\Component\Yaml\Yaml;
use \RuntimeException;


class ConfigurationFactory
{
	/**
	 *	Create
	 */
	public static function createConfiguration()
	{
		$paths = [];
		$config = new Configuration();
		
		foreach([ APP_DIR."/etc/config/*.yaml", APP_DIR."/etc/config/entities/*.yaml" ] as $dir)
			$paths = array_merge($paths, glob($dir));
		
		# now turn paths into data
		$data = [];
		
		foreach($paths as $path)
		{
			try
			{
				$data = array_merge_recursive($data, Yaml::parse(file_get_contents($path)));
			}
			catch(ParseException $exception)
			{
				throw new RuntimeException("Error parsing '".$path."'", 0, $exception);
			}
		}
		
		$config->populateObjectList($data);
		
		return $config;
	}
}