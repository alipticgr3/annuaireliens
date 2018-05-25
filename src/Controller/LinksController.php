<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Links;
use App\Repository\LinksRepository;
use App\Form\AddLinkType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LinksController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
    	$em = $this->getDoctrine()->getManager();
    	$links = $em->getRepository(Links::class)->findAll();

        return $this->render('links/index.html.twig', [
            'links' => $links,
        ]);
    }

	/**
	 * @Route("/add", name="add")
	 */ 
	public function add(Request $request){
	    $link = new Links();

	    $form = $this->createForm(AddLinkType::class, $link);

	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){

	   		$now = new \DateTime();
	   		$link->setDatecreate($now);
	   		$link->setIdcategory(2);
	   		$link->setIduser(6);	   		

	        $em = $this->getDoctrine()->getManager();

	        $em->persist($link);
	        $em->flush();

	        return $this->redirectToRoute('home');
	    }

	    return $this->render('links/add.html.twig', [
	        'form'  =>  $form->createView()
	    ]);
	}

	/**
	 * @Route("/edit/{id}", name="edit")
	 */ 
	public function edit(Links $link, Request $request){
	    $form = $this->createForm(AddLinkType::class, $link);
	    
	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($link);
	        $em->flush();

	        return $this->redirectToRoute('home');
	    }

	    return $this->render('links/add.html.twig', [
	        'form'  =>  $form->createView()
	    ]);
	}

	/**
	 * @Route("/delete/{id}", name="delete")
	 */ 
	public function delete(links $idlink, Request $request)
    {
            $em = $this->getDoctrine()->getManager();
			$link = $em->getRepository(Links::class)->find($idlink);

			$em->remove($link);
			$em->flush();

			return $this->redirectToRoute('home');

    }
	

}
