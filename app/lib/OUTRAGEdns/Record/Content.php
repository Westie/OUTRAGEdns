<?php
/**
 *	Record model for OUTRAGEdns
 */


namespace OUTRAGEdns\Record;

use \OUTRAGEdns\Entity;
use \OUTRAGEdns\Domain;


class Content extends Entity\Content
{
	/**
	 *	What domain does this record template belong to?
	 */
	public function getter_parent()
	{
		return Domain\Content::find()->where("id = ?", $this->domain_id)->invoke("first");
	}
	
	
	/**
	 *	Returns the record name without the name of the parent record.
	 */
	public function getter_prefix()
	{
		return preg_replace("/\\.?".preg_quote($this->parent->name)."$/", "", $this->name);
	}
	
	
	/**
	 *	Called when saving a new record.
	 */
	public function save($post = array())
	{
		if(!isset($post["change_date"]))
			$post["change_date"] = time();
		
		return parent::save($post);
	}
	
	
	/**
	 *	Called when editing an existing record.
	 */
	public function edit($post = array())
	{
		if(!isset($post["change_date"]))
			$post["change_date"] = time();
		
		return parent::edit($post);
	}
}