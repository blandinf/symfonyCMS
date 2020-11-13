<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\OfferRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="offers", methods={"GET"})
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function index(OfferRepository $offerRepository): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $offers = $offerRepository->findAllExceptMine($user);

        return $this->render('offer/index.html.twig', [
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/offers", name="my_offers", methods={"GET"})
     * @param OfferRepository $offerRepository
     * @return Response
     */
    public function indexMyOffers(OfferRepository $offerRepository): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $offers = $offerRepository->findMyOffers($user);

        return $this->render('offer/index.html.twig', [
            'offers' => $offers
        ]);
    }

    /**
     * @Route("/offers/new", name="offer_new", methods={"GET","POST"})
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $fileUploader->upload($imageFile);
                $image = new Image();
                $image->setName($imageFile->getClientOriginalName());
                $image->setPath($imageFile->getPath());
                $offer->setImage($image);
            }
            $offer->setDate(new \DateTime());
            $offer->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('offers');
        }

        return $this->render('offer/new.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offers/{id}", name="offer_show", methods={"GET"})
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/offers/{id}/edit", name="offer_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Offer $offer
     * @param FileUploader $fileUploader
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, Offer $offer, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $fileUploader->upload($imageFile);
                $image = new Image();
                $image->setName($imageFile->getClientOriginalName());
                $image->setPath($imageFile->getPath());
                $offer->setImage($image);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offers');
        }

        return $this->render('offer/edit.html.twig', [
            'offer' => $offer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offers/{id}", name="offer_delete", methods={"DELETE"})
     * @param Request $request
     * @param Offer $offer
     * @return Response
     */
    public function delete(Request $request, Offer $offer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($offer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('offers');
    }
}
