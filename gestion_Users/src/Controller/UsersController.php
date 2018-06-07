<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Form\AdduserType;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UsersController extends Controller
{
    /**
     * @Route("/users", name="users")
   	 * @Security("has_role('ROLE_ADMIN')") 
     */
    public function index()
    {
	   	$em = $this->getDoctrine()->getManager();
	   	$users = $em->getRepository(Users::class)->findAll();
	    return $this->render('users/index.html.twig', [
	        'users' => $users,
	    ]);
	}

    /**
	 * @Route("/adduser", name="adduser")
	 * @Security("has_role('ROLE_ADMIN')") 
	 */ 
	public function add(Request $request, UserPasswordEncoderInterface $encoder){
		    $user = new Users();
		    //$user->setRoles(array('ROLE_USER'));   

			$form = $this->createForm(AdduserType::class, $user);

		    $form->handleRequest($request);
		    $task=$form->getData();
		   
		    if($form->isSubmitted() && $form->isValid()){

		    	

		    	$em = $this->getDoctrine()->getManager();
		    	$user->setIsactive(true);
		    	$verifemail = $user->getEmail();
		    	if ($em->getRepository(Users::class)->findOneBy(['email' => $verifemail])){ /* si l'email existe déjà */
		    		return $this->redirectToRoute('adduser');								/* on retourne à la page add */
		    	}
		    	$plainpassword = $user->getPassword();						/* récupère le password et l'encode par la */
		    	$encoded = $encoder->encodePassword($user, $plainpassword);	/* méthodhe définie dans security.yaml (bcrypt)*/
		    	$user->setPassword($encoded);
		    	$dateday= new \DateTime();
		    	$user->setDatecreate($dateday);

		    	//dump($user);

		    	//exit('yo');
		        $em->persist($user);
		        $em->flush();

		        return $this->redirectToRoute('users');
		    }

		    return $this->render('users/add.html.twig', [
		        'form'  =>  $form->createView()
		    ]);
	}

	/**
	 * @Route("/edituser/{id}", name="edituser")
	 * @Security("has_role('ROLE_USER')")
	 */ 
	public function edit(Users $user, Request $request){
	    $form = $this->createForm(UserType::class, $user);

	    $form->handleRequest($request);
	    
	    if($form->isSubmitted() && $form->isValid()){
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($user);
	        $em->flush();

	        return $this->redirectToRoute('links', array('page' => 1));
	    }
	    return $this->render('users/add.html.twig', [
	        'form'  =>  $form->createView()
	    ]);
	}

	/**
     * @Route("/deluser{id}", name="deluser")
     * @Security("has_role('ROLE_ADMIN')")
     */ 
    // ATTENTION Pas de confirmation avant suppression - A FAIRE
    // J'ai pas testé la suppression d'un user connecté !!!
    public function del(Users $user, Request $request){
        //if ($this->getUser()->getAdmin()){
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();
        //}
        return $this->redirectToRoute('users');
    }
}
