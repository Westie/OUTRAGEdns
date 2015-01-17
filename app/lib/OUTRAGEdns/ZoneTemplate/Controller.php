<?php
/**
 *	ZoneTemplate model for OUTRAGEdns
 */


namespace OUTRAGEdns\ZoneTemplate;

use \OUTRAGEdns\Entity;
use \OUTRAGEdns\Notification;


class Controller extends Entity\Controller
{
	/**
	 *	Called when we want to add a domain.
	 */
	public function add()
	{
		if(!empty($this->request->post->commit))
		{
			if($this->form->validate($this->request->post->toArray()))
			{
				try
				{
					$this->content->db->begin();
					
					$values = $this->form->values();
					
					if($this->response->user)
						$values["owner"] = $this->response->user;
					
					$this->content->save($values);
					$this->content->db->commit();
					
					new Notification\Success("Successfully created the zone template: ".$this->content->name);
					
					header("Location: ".$this->content->actions->edit);
					exit;
				}
				catch(Exception $exception)
				{
					$this->content->db->rollback();
					
					new Notification\Error("This zone template wasn't added due to an internal error.");
				}
			}
		}
		
		# list all the nameservers that are currently defined
		$this->response->nameservers = [];
		
		if(!empty($this->config->records->soa->nameservers))
			$this->response->nameservers = array_merge($this->response->nameservers, $this->config->records->soa->nameservers->toArray());
		
		return $this->response->display("index.twig");
	}
	
	
	/**
	 *	Called when we want to edit a domain.
	 */
	public function edit($id)
	{
		if(!$this->content->id)
			$this->content->load($id);
		
		if(!$this->content->id || (!$this->response->godmode && $this->content->user->id !== $this->response->user->id))
		{
			new Notification\Error("You don't have access to this zone template.");
			
			header("Location: ".$this->content->actions->grid);
			exit;
		}
		
		if(!empty($this->request->post->commit))
		{
			if($this->form->validate($this->request->post->toArray()))
			{
				try
				{
					$this->content->db->begin();
					$this->content->edit($this->form->values());
					$this->content->db->commit();
					
					new Notification\Success("Successfully updated the zone template: ".$this->content->name);
				}
				catch(Exception $exception)
				{
					$this->content->db->rollback();
					
					new Notification\Error("This zone template wasn't edited due to an internal error.");
				}
			}
		}
		
		# list all the nameservers that are currently defined
		$this->response->nameservers = [];
		
		if(!empty($this->config->records->soa->nameservers))
			$this->response->nameservers = array_merge($this->response->nameservers, $this->config->records->soa->nameservers->toArray());
		
		# oh, and it's a good idea to separate out the SOA record(s) from the other
		# records, that way we can make the SOA independently editable
		$this->response->records = array
		(
			"soa" => [],
			"list" => [],
		);
		
		foreach($this->content->records as $record)
		{
			switch($record->type)
			{
				case "SOA":
					$this->response->records["soa"][] = $record;
				break;
				
				case "NS":
					$this->response->nameservers[] = $record->content;
				
				default:
					$this->response->records["list"][] = $record;
				break;
			}
		}
		
		$this->response->nameservers = array_unique($this->response->nameservers);
		
		return $this->response->display("index.twig");
	}
	
	
	/**
	 *	Called when we want to remove a domain.
	 */
	public function remove($id)
	{
		if(!$this->content->id)
			$this->content->load($id);
		
		if(!$this->content->id || (!$this->response->godmode && $this->content->user->id !== $this->response->user->id))
		{
			new Notification\Error("You don't have access to this zone template.");
			
			header("Location: ".$this->content->actions->grid);
			exit;
		}
		
		try
		{
			$this->content->db->begin();
			$this->content->remove();
			$this->content->db->commit();
			
			new Notification\Success("Successfully removed the zone template: ".$this->content->name);
		}
		catch(Exception $exception)
		{
			$this->content->db->rollback();
			
			new Notification\Error("This zone template wasn't removed due to an internal error.");
		}
		
		header("Location: ".$this->content->actions->grid);
		exit;
	}
	
	
	/**
	 *	Called when we want show the grid view.
	 */
	public function grid()
	{
		if(!$this->response->templates)
		{
			$request = Content::find();
			$request->sort("id ASC");
			
			if(!$this->response->godmode)
				$request->where("owner = ?", $this->response->user->id);
			
			$this->response->templates = $request->invoke("objects");
		}
		
		return $this->response->display("index.twig");
	}
}