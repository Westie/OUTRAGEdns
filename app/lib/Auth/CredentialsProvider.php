<?php


namespace OUTRAGEdns\Auth;

use \Silex\Application;
use \Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use \Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use \Symfony\Component\Security\Core\User\User;
use \Symfony\Component\Security\Core\User\UserInterface;
use \Symfony\Component\Security\Core\User\UserProviderInterface;
use \Zend\Db\Sql\Expression;
use \Zend\Db\Sql\Select;
use \Zend\Db\Sql\Sql;


class CredentialsProvider implements UserProviderInterface
{
	/**
	 *	Application
	 */
	protected $app = null;
	
	
	/**
	 *	Create instance
	 */
	public final function __construct(Application $app)
	{
		$this->app = $app;
	}
	
	
	/**
	 *	Load by username
	 */
	public function refreshUser(UserInterface $user)
	{
		if(!$user instanceof User)
			throw new UnsupportedUserException("Invalid input");
		
		return $this->loadUserByUsername($user->getUsername());
	}
	
	
	/**
	 *	Supports class
	 */
	public function supportsClass($class)
	{
		return $class === User::class;
	}
	
	
	/**
	 *	Load by username
	 */
	public function loadUserByUsername($username)
	{
		var_dump($username);
		exit;
	}
}