<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
     * @ORM\Column(type="text", length=100)
     */
	private $title;
	
	 /**
     * @ORM\Column(type="text")
     */
	private $body;

    //getter & setter method
    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        return $this->title=$title;
    }
    
    public function getBody(){
        return $this->body;
    }

    public function setBody($body){
        return $this->body=$body;
    }
       
}
