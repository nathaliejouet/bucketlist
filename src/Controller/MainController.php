<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route ("/", name="mainController_home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route ("/aboutUs", name="mainController_aboutUs")
     */
    public function aboutus()
    {
        return $this->render("main/about-us.html.twig");
    }
}