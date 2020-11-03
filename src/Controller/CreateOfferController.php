<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateOfferController extends AbstractController
{
    /**
     * @Route("/create/offer", name="create_offer")
     */
    public function index(): Response
    {
        return $this->render('create_offer/index.html.twig', [
            'controller_name' => 'CreateOfferController',
        ]);
    }
}
