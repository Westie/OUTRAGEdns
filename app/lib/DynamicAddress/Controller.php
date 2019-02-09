<?php


namespace OUTRAGEdns\DynamicAddress;

use \Exception;
use \OUTRAGEdns\Entity;
use \OUTRAGEdns\Notification;
use \OUTRAGEdns\Response\EntityControllerResponse;
use \Symfony\Component\HttpFoundation\Response;


class Controller extends Entity\Controller
{
	/**
	 *	Called when we want to add a domain.
	 */
	public function add()
	{
		if($this->request->getMethod() == "POST" && $this->request->request->has("commit"))
		{
			if($this->form->validate($this->request->request))
			{
				$connection = $this->db->getAdapter()->getDriver()->getConnection();
				
				try
				{
					$connection->beginTransaction();
					
					$values = $this->form->getValues();
					
					if(empty($values["owner"]))
						$values["owner"] = $this->user->id;
					
					if(empty($values["token"]))
						$values["token"] = sha1(json_encode($values).uniqid().rand(1, 5000));
					
					$this->content->save($values);
					
					$connection->commit();
					
					new Notification\Success("Successfully created the domain: ".$this->content->name);
					
					return $this->app->redirect($this->content->actions->edit);
				}
				catch(Exception $exception)
				{
					$connection->rollback();
					
					new Notification\Error("This domain wasn't added due to an internal error.");
				}
			}
		}
		
		# we will need to get the list of domains that this user owns
		# and use this as the basis for our list
		$list = [];
		
		foreach($this->user->domains as $domain)
		{
			foreach($domain->records as $record)
			{
				switch($record->type)
				{
					case "A":
					case "AAAA":
						if(!isset($list[$domain->id]))
						{
							$list[$domain->id] = [
								"domain" => $domain->name,
								"records" => [],
							];
						}
						
						$list[$domain->id]["records"][$record->id] = sprintf("[%s] %s", $record->type, $record->name);
					break;
				}
			}
			
			if(isset($list[$domain->id]))
				$list[$domain->id]["records"] = array_unique($list[$domain->id]["records"]);
		}
		
		$this->response->available_records = $list;
		
		return EntityControllerResponse::createResponse($this);
	}
	
	
	/**
	 *	Called when we want to edit a domain.
	 */
	public function edit($id)
	{
		if(!$this->content->id)
			$this->content->load($id);
		
		if(!$this->allowed(__FUNCTION__))
		{
			new Notification\Error("You don't have access to this domain.");
			
			return $this->app->redirect($this->content->actions->grid);
		}
		
		if($this->request->getMethod() == "POST" && $this->request->request->has("commit"))
		{
			if($this->form->validate($this->request->request))
			{
				$connection = $this->db->getAdapter()->getDriver()->getConnection();
				
				try
				{
					$connection->beginTransaction();
					
					$values = $this->form->getValues();
					
					if(empty($values["token"]))
						$values["token"] = sha1(json_encode($values).uniqid().rand(1, 5000));
					
					$this->content->edit($values);
					
					$connection->commit();
					
					new Notification\Success("Successfully updated the domain: ".$this->content->name);
				}
				catch(Exception $exception)
				{
					$connection->rollback();
					
					new Notification\Error("This zone template wasn't edited due to an internal error.");
				}
			}
		}
		
		# grab a list of currently selected domains
		$list = [];
		
		foreach($this->content->records as $record)
		{
			if($record->targets)
				$list[] = $record->targets[0]->id;
		}
		
		$this->response->selected_records = $list;
		
		# we will need to get the list of domains that this user owns
		# and use this as the basis for our list
		$list = [];
		
		foreach($this->user->domains as $domain)
		{
			foreach($domain->records as $record)
			{
				switch($record->type)
				{
					case "A":
					case "AAAA":
						if(!isset($list[$domain->id]))
						{
							$list[$domain->id] = [
								"domain" => $domain->name,
								"records" => [],
							];
						}
						
						$list[$domain->id]["records"][$record->id] = sprintf("[%s] %s", $record->type, $record->name);
					break;
				}
			}
			
			if(isset($list[$domain->id]))
				$list[$domain->id]["records"] = array_unique($list[$domain->id]["records"]);
		}
		
		$this->response->available_records = $list;
		
		return EntityControllerResponse::createResponse($this);
	}
	
	
	/**
	 *	Called when we want to remove a domain.
	 */
	public function remove($id)
	{
		if(!$this->content->id)
			$this->content->load($id);
		
		if(!$this->allowed(__FUNCTION__))
		{
			new Notification\Error("You don't have access to this domain.");
			
			return $this->app->redirect($this->content->actions->grid);
		}
		
		$connection = $this->db->getAdapter()->getDriver()->getConnection();
		
		try
		{
			$connection->beginTransaction();
			
			$this->content->remove();
			
			$connection->commit();
			
			new Notification\Success("Successfully removed the domain: ".$this->content->name);
		}
		catch(Exception $exception)
		{
			$connection->rollback();
			
			new Notification\Error("This zone template wasn't removed due to an internal error.");
		}
		
		return $this->app->redirect($this->content->actions->grid);
	}
	
	
	/**
	 *	Called when we want show the grid view.
	 */
	public function grid()
	{
		if(!$this->response->domains)
		{
			$request = Content::find();
			$request->order("id ASC");
			
			if(!$this->app["session"]->get("godmode"))
				$request->where([ "owner" => $this->user->id ]);
			
			$this->response->domains = $request->get("objects");
		}
		
		return EntityControllerResponse::createResponse($this);
	}
	
	
	/**
	 *	Called when we want to update records with a new IP address.
	 */
	public function updateDynamicAddresses($token)
	{
		$this->content = Content::find()->where([ "token" => $token ])->get("first");
		
		if(!$this->content)
			return $this->app->abort(404);
		
		$connection = $this->db->getAdapter()->getDriver()->getConnection();
		
		try
		{
			$connection->beginTransaction();
			
			# and then we need to go through all the records we have, change
			# the value to what is required...
			$ip_addr = null;
			$ip_type = null;
			
			if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
				$ip_addr = array_map("trim", explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]))[0];
			elseif(!empty($_SERVER["REMOTE_ADDR"]))
				$ip_addr = $_SERVER["REMOTE_ADDR"];
			
			if(filter_var($ip_addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
				$ip_type = "A";
			if(filter_var($ip_addr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
				$ip_type = "AAAA";
			
			# and now hunt through all the records, being ruthless
			# in their replacement
			$count = 0;
			$domains = [];
			
			foreach($this->content->records as $record)
			{
				if(!$record->targets)
					continue;
				
				foreach($record->targets as $target)
				{
					if($target->type == $ip_type && $target->content != $ip_addr)
					{
						++$count;
						
						if(!isset($domains[$target->parent->id]))
							$domains[$target->parent->id] = $target->parent;
						
						$target->edit([ "content" => $ip_addr ]);
					}
				}
			}
			
			# now we dive back to the domains - we need to update the serial and
			# log the changes to version management.
			foreach($domains as $domain)
			{
				unset($domain->records);
				
				$domain->updateSerial();
				$domain->log("records", [ "records" => $domain->records ]);
			}
			
			$connection->commit();
		}
		catch(Exception $exception)
		{
			$connection->rollback();
		}
		
		return new Response("", ($count > 0 ? 200 : 304));
	}
}