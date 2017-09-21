<?php

namespace just\Models;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Lcobucci\JWT\Builder;

/**
* @Entity(repositoryClass="just\Repository\UserRepository") @Table(name="user")
**/
class User
{
	/**
	 * @Id
     * @Column(type="integer", name="id")
     * @GeneratedValue(strategy="IDENTITY")
    **/
	protected $id;

	/** @column(name="username", type="string") **/
	protected $username;

	/** @column(name="password", type="string") **/
	protected $password;

	/**
	* @return integer
	**/
	public function getId()
	{
		return $this->id;
	}

	/**
	* @return string
	**/
	public function getUsername()
	{
		return $this->username;
	}

	/**
	* @return string
	*/
	public function getPassword()
	{
		return $this->password;
	}
}

