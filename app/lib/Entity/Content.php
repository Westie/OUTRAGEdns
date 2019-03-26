<?php


namespace OUTRAGEdns\Entity;

use \Exception;
use \OUTRAGElib\Delegator\DelegatorTrait;
use \OUTRAGElib\Structure\ObjectList;
use \OUTRAGElib\Structure\ObjectListPopulationTrait;
use \OUTRAGElib\Structure\ObjectListRetrievalTrait;


class Content extends ObjectList
{
	/**
	 *	Add in required traits
	 */
	use ApplicationDelegatorTrait;
	use ContentDelegatorTrait;
	use DelegatorTrait;
	use EntityDelegatorTrait;
	use ObjectListPopulationTrait;
	use ObjectListRetrievalTrait;
	
	
	/**
	 *	Called on construction
	 */
	public function __construct()
	{
		foreach($this->db_fields as $key)
			$this->list[$key] = null;
	}
	
	
	/**
	 *	Called to load an object into memory.
	 */
	public function load($identifier = null)
	{
		if(is_null($identifier))
			return false;
		
		$select = $this->db->select();
		
		$select->from($this->db_table)
			   ->where([ "id" => $identifier ])
			   ->limit(1);
		
		$statement = $this->db->prepareStatementForSqlObject($select);
		
		foreach($statement->execute() as $result)
			$this->populateObjectList($result);
		
		return $this->id;
	}
	
	
	/**
	 *	Called to save an object to the database, based on an object/array
	 *	passed to this method.
	 */
	public function save($post = array())
	{
		if($this->id)
			return false;
		
		if(method_exists($this, "validate"))
		{
			if(!$this->validate($this, __FUNCTION__, [ $post ]))
				throw new \Exception("Unable to perform action - ".__FUNCTION__);
		}
		
		$values = array_intersect_key($post, array_flip($this->db_fields));
		
		$insert = $this->db->insert();
		$insert->into($this->db_table);
		$insert->values($values);
		
		$statement = $this->db->prepareStatementForSqlObject($insert);
		
		if($result = $statement->execute())
		{
			if($id = $result->getGeneratedValue())
				return $this->load($id);
		}
		
		return false;
	}
	
	
	/**
	 *	Called to update an object to the database, based on an object/array
	 *	passed to this method.
	 */
	public function edit($post = array())
	{
		if(!$this->id)
			return false;
		
		if(method_exists($this, "validate"))
		{
			if(!$this->validate($this, __FUNCTION__, [ $post ]))
				throw new \Exception("Unable to perform action - ".__FUNCTION__);
		}
		
		$values = array_intersect_key($post, array_flip($this->db_fields));
		
		if(count($values) > 0)
		{
			$update = $this->db->update();
			$update->table($this->db_table);
			$update->set($values);
			$update->where([ "id" => $this->id ]);
			
			$statement = $this->db->prepareStatementForSqlObject($update);
			$statement->execute();
		}
		
		return $this->load($this->id);
	}
	
	
	/**
	 *	Called to remove an object.
	 */
	public function remove()
	{
		if(method_exists($this, "validate"))
		{
			if(!$this->validate($this, __FUNCTION__, []))
				throw new \Exception("Unable to perform action - ".__FUNCTION__);
		}
		
		$delete = $this->db->delete();
		$delete->from($this->db_table);
		$delete->where([ "id" => $this->id ]);
		
		$statement = $this->db->prepareStatementForSqlObject($delete);
		$statement->execute();
		
		return true;
	}
	
	
	/**
	 *	We can use this to find objects that match what we want to find.
	 *	Now can be called statically!
	 */
	public static function find()
	{
		$class = "\\".get_called_class();
		$content = new $class();
		
		if($content->namespace)
		{
			$target = "\\".$content->namespace."\\Find";
			
			if(class_exists($target))
				return new $target($content);
		}
		
		return new Find($content);
	}
	
	
	/**
	 *	It would be good to log certain things (perhaps)
	 */
	public function log($action, $state = null)
	{
		if(!$this->id)
			return false;
		
		$post = [
			"content_type" => get_class($this),
			"content_id" => $this->id,
			"action" => $action,
			"state" => serialize($state),
			"the_date" => time(),
		];
		
		$insert = $this->db->insert();
		$insert->into("logs");
		$insert->values($post);
		
		$statement = $this->db->prepareStatementForSqlObject($insert);
		$statement->execute();
		
		return true;
	}
	
	
	/**
	 *	Let's mute certain things
	 */
	public function __debugInfo()
	{
		$data = get_object_vars($this);
		
		unset($data["app"]);
		unset($data["config"]);
		unset($data["db"]);
		
		return $data;
	}
}