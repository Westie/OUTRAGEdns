<?php


namespace OUTRAGEdns\Record;

use \Exception;
use \Symfony\Component\Yaml\Yaml;


class RDATA
{
	/**
	 *	Store RDATA
	 */
	protected static $rdata = [];
	
	
	/**
	 *	Store exclusions data
	 */
	protected static $exclusions = [
		"MX" => [
			"PREFERENCE" => "prio",
		],
		"SRV" => [
			"PRIORITY" => "prio",
		],
	];
	
	
	/**
	 *	Does this type exist?
	 */
	public static function has($type)
	{
		if(empty(self::$rdata))
		{
			$file = APP_DIR."/etc/RDATA/RDATA.yml";
			
			if(!file_exists($file))
				throw new Exception("RDATA file is missing - are all submodules loaded?");
			
			self::$rdata = Yaml::parse(file_get_contents($file));
		}
		
		return isset(self::$rdata[$type]);
	}
	
	
	/**
	 *	Retrieve RDATA
	 */
	public static function get($type)
	{
		if(self::has($type))
			return self::$rdata[$type];
		
		return null;
	}
	
	
	/**
	 *	Retrieves the mapping of exclusions to fields which are represented within PowerDNS
	 */
	public static function getExclusions($type)
	{
		if(isset(self::$exclusions[$type]))
			return self::$exclusions[$type];
		
		return [];
	}
}