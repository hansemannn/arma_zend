<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Book {

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
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="books")
     * @var \Application\Author
     */
    protected $author;

    /**
     * @ORM\Column(type="integer");
     * @var int
     */
    protected $pages;

    /**
     * @ORM\Column(type="date");
     * @var \DateTime
     */
    protected $releaseDate;

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
     * Get the value of Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param string title
     *
     * @return self
     */
    public function setTitle($value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * Get the value of Author
     *
     * @return \Application\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of Author
     *
     * @param \Application\Author author
     *
     * @return self
     */
    public function setAuthor(\Application\Author $value)
    {
        $this->author = $value;

        return $this;
    }

    /**
     * Get the value of Pages
     *
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set the value of Pages
     *
     * @param int pages
     *
     * @return self
     */
    public function setPages($value)
    {
        $this->pages = $value;

        return $this;
    }

    /**
     * Get the value of Release Date
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set the value of Release Date
     *
     * @param \DateTime releaseDate
     *
     * @return self
     */
    public function setReleaseDate(\DateTime $value)
    {
        $this->releaseDate = $value;

        return $this;
    }

}
