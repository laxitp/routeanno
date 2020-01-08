<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answers
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

    public $question_id;

    /**
    * @ORM\Column(type="text")
    */

    public $answer;

    /**
    * @ORM\Column(type="text")
    */

    public $tags;



    // Getters & Setters
    public function getId() {
        return $this->id;
    }

    public function getQuestion() {
        return $this->question_id;
    }

    public function setQuestion($question) {
        $this->question_id = $question;
    }

     public function setAnswer($answer) {
        $this->answer = $answer;
    }

    public function getTag() {
        return $this->tags;
    }

    public function settags($tags) {
        $this->tags = $tags;
    }
}
