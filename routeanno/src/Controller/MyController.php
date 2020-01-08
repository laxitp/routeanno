<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use App\Entity\Questions;
use App\Entity\Answers;

class MyController extends AbstractController {

     
     /**
     * @Route("/addQuestion", name="addQuestion")
     * Method({"GET", "POST"})
     */
    public function addQuestion(Request $request) 
    {
        $question = $request->get('question');
        $rank = $request->get('rank'); 
        $data = array("question"=>$question,"rank"=>$rank);
        $genus = new Questions();
        $genus->setQuestion($question);
        $genus->setRank($rank);
        $genus->setSlug($question);
        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();

        return $this->json(array(['status' => 200, 'message' =>"Question Added Successfully", "response"=>""]));
    }


     /**
     * @Route("/question_list", name="question_list")
     * Method({"GET", "POST"})
     */
    public function question_list(Request $request) {   
    
       // $questions = $this->getDoctrine()->getRepository('App\Entity\Questions')
       // ->findBy(array(),array('rank'=>$request->get('sort_by')));

    $limit = $request->get('limit');
    $offset  = $request->get('offset');
    $questions = $this->getDoctrine()->getRepository('App\Entity\Questions')
                ->findList($request->get('sort_rank'), $limit, $offset );

 
      foreach ($questions as $key => $value) {
                $data['id'] =  $value->id;
                $data['quesion'] =  $value->question;
                $data['rank'] = $value->rank;

                $answer_datas = [];

                $answers = $this->getDoctrine()->getRepository('App\Entity\Answers')->findBy(array("question_id"=>$value->id),array());

                foreach ($answers as $key1 => $value1) {
                    $answer_data['id'] =  $value1->id;
                    $answer_data['answer'] =  $value1->answer; 
                    $answer_data['tags'] =  $value1->tags; 
                    $answer_datas[]=$answer_data;
                }
                 $data['answers']=$answer_datas;
                 $data['slug'] = $value->slug;

                $datas[]=$data;

             }
             if(!empty($datas)){
                   return $this->json(array(['status' => 200, 'message' =>"Questions Listed Successfully", 'response' =>$datas]));
               }else{
                 return $this->json(array(['status' => 400, 'message' =>"No Questions Found", 'response' =>""]));
               }   
    }

    /**
     * @Route("/answerDetail", name="answerDetail")
     * Method({"GET", "POST"})
     */

     public function answerDetail(Request $request) 
    {
        $question_id = $request->get('question_id');
        $question = $this->getDoctrine()->getRepository('App\Entity\Questions')
        ->find($question_id);

         $answers = $this->getDoctrine()->getRepository('App\Entity\Answers')->findBy(array("question_id"=>$question_id),array());
         $answer_datas = [];

                foreach ($answers as $key1 => $value1) {
                    $answer_data['id'] =  $value1->id;
                    $answer_data['answer'] =  $value1->answer; 
                     $answer_data['tags'] =  $value1->tags; 
                    $answer_datas[]=$answer_data;
                }
             $data['question'] = $question->question;
             $data['answers']=$answer_datas;
             if(!empty($data)){
               return $this->json(array(['status' => 200, 'message' =>"Answer Detail Listed Successfully", 'response' =>$data]));
           }else{
             return $this->json(array(['status' => 400, 'message' =>"No Questions Found", 'response' =>""]));
           }   
    }



     /**
     * @Route("/addAnswer", name="addAnswer")
     * Method({"GET", "POST"})
     */
    public function addAnswer(Request $request) 
    {
        $question_id = $request->get('question_id');
        $tags = $request->get('tags');
        $answer = $request->get('answer');
        
        $genus = new Answers();
        $genus->setQuestion($question_id);
        $genus->setAnswer($answer);
        $genus->settags($tags);
        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();

        return $this->json(array(['status' => 200, 'message' =>"Answers Added Successfully", "response"=>""]));
       
    }



}
