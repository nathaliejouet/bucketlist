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
     * @Route ("/about-us", name="mainController_about-us")
     */
    public function aboutUs()
    {
        return $this->render("main/about-us.html.twig");
    }
}