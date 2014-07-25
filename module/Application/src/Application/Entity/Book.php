<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Book {
	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	protected $id;

	/** @ORM\Column(type="integer") */
	protected $id_author;

	/** @ORM\Column(type="string") */
	protected $title;

	/** @ORM\Column(type="integer") */
	protected $pages;

	/** @ORM\Column(type="date") */
	protected $releasedate;

	public function getId()
	{
		return $this->id;
	}

	public function getId_Author()
	{
		return $this->id_author;
	}

	public function getPages()
	{
		return $this->pages;
	}

	public function releasedate()
	{
		return $this->releasedate;
	}

	public function setId($id) {
        $this->id = $id;
    }

    public function setId_Author($id_author) {
        $this->id_author = $id_author;
    }

    public function setPages($pages) {
        $this->pages = $pages;
    }

    public function setReleasedate($releasedate) {
        $this->releasedate = $releasedate;
    }
}