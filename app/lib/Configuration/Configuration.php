<?php


namespace OUTRAGEdns\Configuration;

use \OUTRAGElib\Delegator\DelegatorTrait;
use \OUTRAGElib\Structure\ObjectList;
use \OUTRAGElib\Structure\ObjectListPopulationTrait;
use \OUTRAGElib\Structure\ObjectListRetrievalTrait;
use \Symfony\Component\Yaml\Exception\ParseException;
use \Symfony\Component\Yaml\Yaml;
use \RuntimeException;


class Configuration extends ObjectList
{
	/**
	 *	Some traits to boost the functionality of ObjectList
	 */
	use DelegatorTrait;
	use ObjectListPopulationTrait;
	use ObjectListRetrievalTrait;
	
	
	/**
	 *	Singleton
	 */
	public static function getInstance()
	{
		static $instance = null;
		
		if(is_null($instance))
		{
			# retrieve paths
			$paths = [];
			
			$paths = array_merge($paths, glob(APP_DIR."/etc/config/*.yaml"));
			$paths = array_merge($paths, glob(APP_DIR."/etc/config/entities/*.yaml"));
			
			$instance = new self();
			
			# now turn paths into data
			$array = [];
			
			foreach($paths as $path)
			{
				try
				{
					$array = array_merge_recursive($array, Yaml::parse(file_get_contents($path)));
				}
				catch(ParseException $exception)
				{
					throw new RuntimeException("Error parsing '".$path."'", 0, $exception);
				}
			}
			
			$instance->populateObjectList($array);
		}
		
		return $instance;
	}
}