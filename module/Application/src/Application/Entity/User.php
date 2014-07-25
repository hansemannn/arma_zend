<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User {
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

	/** @ORM\Column(type="string") */
	protected $username;

	/** @ORM\Column(type="string") */
	protected $password;

	/** @ORM\Column(type="date") */
	protected $birthdate;

	/** @ORM\Column(type="string") */
	protected $role = 'guest';

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

	public function getUsername()
	{
		return $this->username;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getBirthdate()
	{
		return $this->birthdate;
	}

	public function getRole()
	{
		return $this->role;
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

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}