<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportedOffersController extends AbstractController
{
    /**
     * @Route("/reported/offers", name="reported_offers")
     */
    public function index(): Response
    {
        return $this->render('reported_offers/index.html.twig', [
            'controller_name' => 'ReportedOffersController',
        ]);
    }
}
