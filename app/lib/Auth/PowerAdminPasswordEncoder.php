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
		return sha1($raw) === $encoded;
	}
}