<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="profiles")
 */
class Profiles
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(type="string") 
     */
    protected $image;

    /** 
     * @ORM\Column(type="string") 
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

    public function getImage()
    {
        return $this->$image;
    }

    public function setImage($image)
    {
        $this->$image = $image;
    }

    public function getTitle()
    {
        return $this->$title;
    }

    public function setTitle($title)
    {
        $this->$title = $title;
    }
}