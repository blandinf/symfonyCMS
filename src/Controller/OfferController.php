<?php

namespace App\Controller;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
    /**
     * @Route("/offer", name="offer")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $offer = new Offer();
        $offer->setTitle('chatons');
        $offer->setDescription('chatons à donner');
        $offer->setCategory('animaux');
        $offer->setPrice('0');

        //$em->persist($offer);
        //$em->flush();

        return $this->render('offer/index.html.twig', [
            'controller_name' => 'OfferController',
        ]);
    }
}
