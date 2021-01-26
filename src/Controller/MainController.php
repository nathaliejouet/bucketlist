<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route ("/", name="mainController_home")
     */
    public function home() : Response
    {
        return $this->render('main/home.html.twig', []);
    }

    /**
     * @Route ("/about-us", name="mainController_about-us")
     */
    public function aboutUs() : Response
    {
        return $this->render('main/about-us.html.twig', []);
    }
}