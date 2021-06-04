<?php

namespace App\Controller;

use App\Entity\Pc;
use App\Entity\Revendeur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'catalogue')]
    public function index(): Response
    {
        $user = $this->getUser()->getId();
        $revendeur = $this->getDoctrine()->getRepository(Revendeur::class)->findOneBy(['user' => $user]);



        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'revendeur' => $revendeur,
        ]);
    }
}