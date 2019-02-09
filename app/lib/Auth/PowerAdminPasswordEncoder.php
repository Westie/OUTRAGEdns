<?php


namespace OUTRAGEdns\Auth;


class PowerAdminPasswordEncoder implements \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface
{
	/**
	 *	Encodes the raw password.
	 */
	public function encodePassword($raw, $salt)
	{
		return sha1($raw);
	}
	
	
	/**
	 *	Checks a raw password against an encoded password.
	 */
	public function isPasswordValid($encoded, $raw, $salt)
	{
		$strlen = strlen($encoded);
		
		if($strlen === 32)
			return sha1($raw) === $encoded;
		elseif($strlen === 40)
			return sha1($raw) === $encoded;
		
		return false;
	}
}