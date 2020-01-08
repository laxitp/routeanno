<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /*public function getId(): ?int
    {
        return $this->id;
    }*/

    /**
    * @ORM\Column(type="text", length=100)
    */

    public $question;

    /**
    * @ORM\Column(type="text")
    */

    public $rank;

        /**
    * @ORM\Column(type="text")
    */

    public $slug;

    // Getters & Setters
    public function getId() {
        return $this->id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getRank() {
        return $this->rank;
    }

    public function setRank($rank) {
        $this->rank = $rank;
    }
     public function setSlug($slug)
    {
        $this->slug = preg_replace('/[^a-z0-9]/','-',strtolower(trim(strip_tags($slug))));
    }
}
