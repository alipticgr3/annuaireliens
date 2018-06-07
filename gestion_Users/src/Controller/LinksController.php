<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LinksController extends Controller
{
    /**
     * @Route("/links", name="links")
     */
    public function index()
    {
        return $this->render('links/index.html.twig', [
            'controller_name' => 'LinksController',
        ]);
    }
}
