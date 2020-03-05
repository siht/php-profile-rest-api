<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="profiles")
 */
class Profile
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(type="string", options={"default": "N/A"}) 
     */
    protected $name;


    /** 
     * @ORM\Column(type="string", options={"default": "N/A"}) 
     */
    protected $image;

    /** 
     * @ORM\Column(type="string", options={"default": "N/A"}) 
     */
    protected $title;

    /** 
     * @ORM\Column(type="datetime") 
     */
    protected $reg_date;

    public function __construct()
    {
        $this->reg_date = new DateTime(); 
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDate()
    {
        return $this->reg_date;
    }
}
