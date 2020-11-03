<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAccountController extends AbstractController
{
    /**
     * @Route("/admin/account", name="admin_account")
     */
    public function index(): Response
    {
        return $this->render('admin_account/index.html.twig', [
            'controller_name' => 'AdminAccountController',
        ]);
    }
}
