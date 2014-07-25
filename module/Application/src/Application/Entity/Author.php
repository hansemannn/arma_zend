<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Author {

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
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="date");
     * @var \DateTime
     */
    protected $birthDate;

    /**
     * @ORM\OneToMany(targetEntity="\Application\Entity\Book", mappedBy="author", cascade="persist")
     * @var \Doctrine\Common\Collections\ArrayCollection<\Application\Entity\Book>
     */
    protected $books;

    public function __construct() {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Get the value of Birth Date
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of Birth Date
     *
     * @param \DateTime birthDate
     *
     * @return self
     */
    public function setBirthDate(\DateTime $value)
    {
        $this->birthDate = $value;

        return $this;
    }

}
