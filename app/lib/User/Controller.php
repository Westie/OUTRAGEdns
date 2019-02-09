<?php


namespace OUTRAGEdns\User;

use \OUTRAGEdns\Entity;
use \OUTRAGEdns\Notification;
use \OUTRAGEdns\Response\EntityControllerResponse;


class Controller extends Entity\Controller
{
	/**
	 *	Called when we want to add a domain.
	 */
	public function add()
	{
		$this->form->rulesAdd();
		
		if($this->app["session"]->get("godmode"))
			$this->form->rulesAdmin();
		
		if($this->request->getMethod() == "POST" && $this->request->request->has("commit"))
		{
			if($this->form->validate($this->request->request))
			{
				$connection = $this->db->getAdapter()->getDriver()->getConnection();
				
				try
				{
					$connection->beginTransaction();
					
					$this->content->save($this->form->getValues());
					
					$connection->commit();
					
					new Notification\Success("Successfully added this user.");
					
					return $this->app->redirect($this->content->actions->edit);
				}
				catch(Exception $exception)
				{
					$connection->rollback();
					
					new Notification\Error("This user wasn't added due to an internal.");
				}
			}
		}
		
		return EntityControllerResponse::createResponse($this);
	}
	
	
	/**
	 *	Called when we want to edit a user.
	 */
	public function edit($id)
	{
		$this->form->rulesEdit();
		
		if($this->app["session"]->get("godmode"))
			$this->form->rulesAdmin();
		
		if(!$this->content->id)
			$this->content->load($id);
		
		if(!$this->allowed(__FUNCTION__))
		{
			new Notification\Error("You don't have access to this user.");
			
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
					
					$this->content->edit($this->form->getValues());
					
					$connection->commit();
					
					if($this->request->session->current_users_id == $this->content->id)
						new Notification\Success("Successfully updated your profile.");
					else
						new Notification\Success("Successfully updated this user.");
				}
				catch(Exception $exception)
				{
					$connection->rollback();
					
					new Notification\Error("This user wasn't edited due to an internal.");
				}
			}
		}
		
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
			new Notification\Error("You don't have access to this user.");
			
			return $this->app->redirect($this->content->actions->grid);
		}
		
		$connection = $this->db->getAdapter()->getDriver()->getConnection();
		
		try
		{
			$connection->beginTransaction();
			
			$this->content->remove();
			
			$connection->commit();
			
			new Notification\Success("Successfully removed this user.");
		}
		catch(Exception $exception)
		{
			$connection->rollback();
					
			new Notification\Error("This user wasn't removed due to an internal.");
		}
		
		return $this->app->redirect($this->content->actions->grid);
	}
	
	
	/**
	 *	Called when we want show the grid view.
	 */
	public function grid()
	{
		if($this->app["session"]->get("godmode"))
		{
			header("Location: /");
			exit;
		}
		
		if(!$this->users)
		{
			$request = Content::find();
			$request->order("id ASC");
			
			$this->users = $request->get("objects");
		}
		
		return EntityControllerResponse::createResponse($this);
	}
	
	
	/**
	 *	Called when we want a user to access their account.
	 */
	public function account()
	{
		return $this->edit($this->user->id);
	}
	
	
	/**
	 *	So, we have a dashboard now.
	 */
	public function dashboard()
	{
		return EntityControllerResponse::createResponse($this);
	}
}
