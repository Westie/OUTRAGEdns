<?php


namespace OUTRAGEdns\User;

use \OUTRAGEdns\Auth\PowerAdminPasswordEncoder as DefaultPasswordEncoder;
use \OUTRAGEdns\Domain;
use \OUTRAGEdns\Entity;
use \OUTRAGEdns\ZoneTemplate;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\Security\Core\User\UserInterface;


class Content extends Entity\Content implements UserInterface
{
	/**
	 *	What zone templates does this user own?
	 */
	protected function getter_templates()
	{
		if(!$this->id)
			return null;
		
		return ZoneTemplate\Content::find()->where([ "owner" => $this->id ])->order("id ASC")->get("objects");
	}
	
	
	/**
	 *	How many zone templates does this user own?
	 */
	protected function getter_templates_no()
	{
		if(!$this->id)
			return 0;
		
		return ZoneTemplate\Content::find()->where([ "owner" => $this->id ])->get("count");
	}
	
	
	/**
	 *	What domains does this user own?
	 */
	protected function getter_domains()
	{
		if(!$this->id)
			return null;
		
		return Domain\Content::find()->join("zones", "zones.domain_id = domains.id")->where([ "zones.owner" => $this->id ])->order("id ASC")->get("objects");
	}
	
	
	/**
	 *	How many domains does this user own?
	 */
	protected function getter_domains_no()
	{
		if(!$this->id)
			return 0;
		
		return Domain\Content::find()->join("zones", "zones.domain_id = domains.id")->where([ "zones.owner" => $this->id ])->get("count");
	}
	
	
	/**
	 *	Called to save the user.
	 */
	public function save($post = array())
	{
		if(array_key_exists("password", $post) && strlen($post["password"]) > 0)
			$post["password"] = (new DefaultPasswordEncoder())->encodePassword($post["password"], null);
		
		return parent::save($post);
	}
	
	
	/**
	 *	Called to edit the user.
	 */
	public function edit($post = array())
	{
		if(array_key_exists("password", $post) && strlen($post["password"]) > 0)
			$post["password"] = (new DefaultPasswordEncoder())->encodePassword($post["password"], null);
		
		return parent::edit($post);
	}
	
	
	/**
	 *	UserInterface: get roles
	 */
	public function getRoles()
	{
		$roles = [ "ROLE_USER" ];
		
		if($this->admin)
			$roles[] = "ROLE_ADMIN";
		
		return $roles;
	}
	
	
	/**
	 *	UserInterface: get password hash
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	
	/**
	 *	UserInterface: get salt
	 */
	public function getSalt()
	{
		return null;
	}
	
	
	/**
	 *	UserInterface: get username
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	
	/**
	 *	UserInterface: remove sensitive data
	 */
	public function eraseCredentials()
	{
		return;
	}
}