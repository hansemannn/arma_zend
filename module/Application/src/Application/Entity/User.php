<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $email;

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * Get the value of Username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of Username
     *
     * @param string username
     *
     * @return self
     */
    public function setUsername($value)
    {
        $this->username = $value;

        return $this;
    }

    /**
     * Get the value of First Name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of First Name
     *
     * @param string firstName
     *
     * @return self
     */
    public function setFirstName($value)
    {
        $this->firstName = $value;

        return $this;
    }

    /**
     * Get the value of Last Name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of Last Name
     *
     * @param string lastName
     *
     * @return self
     */
    public function setLastName($value)
    {
        $this->lastName = $value;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param string email
     *
     * @return self
     */
    public function setEmail($value)
    {
        $this->email = $value;

        return $this;
    }

}

?>
