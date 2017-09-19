<?php

namespace just\Models;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
* @Entity(repositoryClass="just\Repository\PostRepository") @Table(name="posts")
**/
class Post
{
	/**
	 * @Id
     * @Column(type="integer", name="id")
     * @GeneratedValue(strategy="IDENTITY")
    **/
	protected $id;

	/** @column(name="title", type="string") **/
	protected $title;

	/** @column(name="body", type="string") **/
	protected $body;

	/** @column(name="path", type="string") **/
	protected $path;

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
	public function getTitle()
	{
		return $this->title;
	}

	/**
	* @param string $title
	* @return Post
	*/
	public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	* @return string
	*/
	public function getBody()
	{
		return $this->body;
	}

	/**
	* @param string $body
	* @return Post
	*/
	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	/**
	* @return string
	*/
	public function getPath()
	{
		return $this->path;
	}

	/**
	* @param string $path
	* @return Post
	*/
	public function setPath($path)
	{
		$this->path = $path;
		return $this;
	}
}

