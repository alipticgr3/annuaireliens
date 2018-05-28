<?php

namespace App\Controller;

use App\Entity\Links;
//use App\Entity\Users;
use App\Form\LinksType;
use App\Repository\LinksRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LinksController extends Controller
{
    /**
     * @Route("/links{page}", requirements={"page" = "\d+"}, name="links")
     */
    public function indexAction($page)
    {
    	$nbLiensParPage = 4; /* nombre de liens à afficher par page */

        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository(Links::class)
            ->findAllPagineEtTrie($page, $nbLiensParPage);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($links) / $nbLiensParPage),
            'nomRoute' => 'links',
            'paramsRoute' => array()
        );
        return $this->render('links/index.html.twig', [
	       	'links' => $links,
	       	'pagination' => $pagination
	    ]);
    }

    /**
     * @Route("/addlink", name="addlink")
     * @Security("has_role('ROLE_USER')")
     */ 
    public function add(Request $request){
        $link = new Links();
        $form = $this->createForm(LinksType::class, $link);

        $form->handleRequest($request);
                
        if($form->isSubmitted() && $form->isValid()){
            $link->setIdUser($this->getUser('id'));     /* Récupère l'id user connécté et l'injecte dans le lien */
            $em = $this->getDoctrine()->getManager();
            $em->persist($link);
            $em->flush();

            return $this->redirectToRoute('links', array('page' => 1));
        }

        return $this->render('links/add.html.twig', [
            'form'  =>  $form->createView(),
        ]);
    }

    /**
     * @Route("/editlink{id}", name="editlink")
     * @Security("has_role('ROLE_USER')")
     */ 
    public function edit(Links $link, Request $request){
        if ($link->getIduser() == $this->getUser('id') || $this->getUser()->getAdmin()){ /* test si le lien appartient au user */
            $form = $this->createForm(LinksType::class, $link);                          /* connécté ou s'il est admin         */

            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($link);
                $em->flush();

                return $this->redirectToRoute('links', array('page' => 1));
            }

            return $this->render('links/add.html.twig', [
                'form'  =>  $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/dellink{id}", name="dellink")
     * @Security("has_role('ROLE_USER')")
     */ 
    // ATTENTION Pas de confirmation avant suppression - A FAIRE
    public function del(Links $link, Request $request){
        if ($link->getIduser() == $this->getUser('id') || $this->getUser()->getAdmin()){
                $em = $this->getDoctrine()->getManager();
                $em->remove($link);
                $em->flush();
        }
        return $this->redirectToRoute('links', array('page' => 1));
    }
}
