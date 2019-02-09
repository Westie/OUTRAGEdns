<?php


namespace OUTRAGEdns\Auth;

use \OUTRAGEdns\User\Content as UserContent;
use \Silex\Application;
use \Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use \Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
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
		return $this->loadUserByUsername($user->getUsername());
	}
	
	
	/**
	 *	Supports class
	 */
	public function supportsClass($class)
	{
		return $class === UserContent::class;
	}
	
	
	/**
	 *	Load by username
	 */
	public function loadUserByUsername($username)
	{
		$object = UserContent::find()->where([ "username" => $username ])->get("first");
		
		if(!$object)
			throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
		
		return $object;
	}
}