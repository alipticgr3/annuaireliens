<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UsersType;		/* J'ai crée 2 formulaires pour pouvoir gérer l'encodage du Password */
use App\Form\AdduserType;	/* Je pense qu'on peut le faire avec un extend de formulaire - Pas encore planché dessus*/
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class UsersController extends Controller
{
    /**
     * @Route("/users", name="users")
	 * @Security("has_role('ROLE_USER')")     
     */
    public function index()
    {
    	if ($this->getUser()->getAdmin()){
	    	$em = $this->getDoctrine()->getManager();
	    	$users = $em->getRepository(Users::class)->findAll();
	        return $this->render('users/index.html.twig', [
	            'users' => $users,
	        ]);
	    }
	    else{
			return $this->redirectToRoute('home');
		}
    }

    /**
     * @Route("/viewuser{id}", name="viewuser")
     */
    public function view(Users $user){
	    return $this->render('users/view.html.twig', [
	        'user'    =>  $user
	    ]);
	}

	/**
	 * @Route("/adduser", name="adduser")
	 * @Security("has_role('ROLE_USER')")
	 */ 
	public function add(Request $request, UserPasswordEncoderInterface $encoder){
		if ($this->getUser()->getAdmin()){  /* Seul un Admin peut ajouter des utilisateurs */
		    $user = new Users();
		    $form = $this->createForm(AdduserType::class, $user);

		    $form->handleRequest($request);
		    
		    if($form->isSubmitted() && $form->isValid()){
		    	$em = $this->getDoctrine()->getManager();
		    	$verifemail = $user->getEmail();
		    	if ($em->getRepository(Users::class)->findOneBy(['email' => $verifemail])){ /* si l'email existe déjà */
		    		return $this->redirectToRoute('adduser');								/* on retourne à la page add */
		    	}
		    	$plainpassword = $user->getPassword();						/* récupère le password et l'encode par la */
		    	$encoded = $encoder->encodePassword($user, $plainpassword);	/* méthodhe définie dans security.yaml (bcrypt)*/
		    	$user->setPassword($encoded);								/* puis on l'injecte dans le user */
		    	/* Pour faire fonctionner la sécurité utilisateur, on a besoin d'un champs username unique, c'est pour ça que je l'ai */
		    	/* rajouté dans la base (en fait je pense qu'on peut s'en passer vu qu'on se connecte avec l'email) - A VOIR          */
		    	/* Création d'un username : majuscule des 4 premiers caractère du nom + 4 du prénom + un chiffre entre 1000 et 9999 */
		    	$verifusername=substr(mb_strtoupper($user->getLastname()),0,4).substr(mb_strtoupper($user->getFirstname()),0,4).rand(1000,9999);
		    	while($em->getRepository(Users::class)->findOneBy(['username' => $verifusername])){
		    		$verifusername=substr($verifusername,0,8).rand(1000,9999);
		    	}										/* Pour être sur que le username est unique on test s'il existe une correspondance */
		    	$user->setUsername($verifusername);		/* dans la base - Si c'est le cas on régénère le chiffre et on boucle */
		        $em->persist($user);
		        $em->flush();

		        return $this->redirectToRoute('users');
		    }

		    return $this->render('users/add.html.twig', [
		        'form'  =>  $form->createView()
		    ]);
		}
		else{
			return $this->redirectToRoute('home');
		}
	}

	/**
	 * @Route("/edituser/{id}", name="edituser")
	 */ 
	public function edit(Users $user, Request $request){
	    $form = $this->createForm(UsersType::class, $user);

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
     * @Security("has_role('ROLE_USER')")
     */ 
    // ATTENTION Pas de confirmation avant suppression - A FAIRE
    // J'ai pas testé la suppression d'un user conécté !!!
    public function del(Users $user, Request $request){
        if ($this->getUser()->getAdmin()){
                $em = $this->getDoctrine()->getManager();
                $em->remove($user);
                $em->flush();
        }
        return $this->redirectToRoute('users');
    }
}
