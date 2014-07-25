<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Author {
	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	protected $id;

	/** @ORM\Column(type="string") */
	protected $name;

	/** @ORM\Column(type="string") */
	protected $surname;

	/** @ORM\Column(type="date") */
	protected $birthdate;

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getSurname()
	{
		return $this->surname;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
}