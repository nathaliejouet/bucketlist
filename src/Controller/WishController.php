<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wishController_list")
     */
    public function list() : Response
    {
        return $this->render('wish/list.html.twig', []);
    }

    /**
     * @Route("/wish/{id}", name="wishController_detail", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function detail($id) : Response
    {
        dump($id);
        return $this->render('wish/detail.html.twig', []);
    }
}
