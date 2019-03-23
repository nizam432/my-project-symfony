<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpKernel\Exception;

class ArticleController extends Controller
{
	/**
	*  @Route("/",name="article_list")
	*  @Method({"GET"})
	*/
	public function index(){
		$articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
		return $this->render('articles/index.html.twig',array('articles'=>$articles));
	}



	/**
	* @Route("article/new",name="new_article")
	* @Method({"GET","POST"})
	*/

	public function new(Request $request){
		//$articles=$this->getDoctrine()->getRepository();
		$article=new Article();
		$form=$this->createFormBuilder($article)
		->add('title',TextType::class,array('attr'=>array('class' => 'form-control')))
		->add('body',TextareaType::class,array('attr'=>array('class' => 'form-control')))
		->add('save',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary mb-3')))
		->getForm();

		return $this->render('articles/new.html.twig',array('form' =>$form->createView()));
	}

	/**
	*  @Route("delete/{id}")
	*  @Method({"DELETE"})
	*/
	public function delete(Request $request, $id){
		$article=$this->getDoctrine()->getRepository(Article::class)->find($id);
		$entityManager=$this->getDoctrine()->getManager();
		$entityManager->remove($article);
		$entityManager->flush();
		$response= new Response();
		return $response->send();
	}


	/**
	*  @Route("article/{id}", name="article_show")
	*/	

	public function show($id){
		$article=$this->getDoctrine()->getRepository(Article::class)->find($id);
		return $this->render('articles/show.html.twig',array('article'=>$article));
	}	



	/**
	*  @Route("article/save")
	*/
	public function save(){
		$entityManager=$this->getDoctrine()->getManager();
		$article=new Article();
		$article->setTitle('Article Title One');
		$article->setBody('Article Body One');
		$entityManager->persist($article);
		$entityManager->flush();
		return new Response('Save an article with '.$article->getID());
	}

}