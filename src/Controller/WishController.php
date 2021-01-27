<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish/add", name="wish_add")
     */
    public function add(EntityManagerInterface $emi): Response
    {
        $wish = new Wish();
        $wish->setTitle('Sauter en parachute');
        $wish->setAuthor('Nathalie');
        $wish->setDescription('Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et venustatis');
        $wish->setIsPublished('true');
        $wish->setDateCreated(new \DateTime());

        $wish2 = new Wish();
        $wish2->setTitle('Voyager en Inde');
        $wish2->setAuthor('Alexandre');
        $wish2->setDescription('Exsistit autem hoc loco quaedam quaestio subdifficilis, num quando amici novi, digni amicitia, veteribus sint anteponendi');
        $wish2->setIsPublished('false');
        $wish2->setDateCreated(new \DateTime());

        $wish3 = new Wish();
        $wish3->setTitle('Faire le tour du monde');
        $wish3->setAuthor('Sophie');
        $wish3->setDescription('Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum ');
        $wish3->setIsPublished('false');
        $wish3->setDateCreated(new \DateTime());

        $emi->persist($wish);
        $emi->persist($wish2);
        $emi->persist($wish3);
        $emi->flush();
        return $this->render('wish/list.html.twig', []);
    }

    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(WishRepository $wr): Response
    {
        $records = $wr->findBy(
            ['isPublished' => 'true'],
            ['title' => 'ASC']
        );
        dump($records);
        return $this->render('wish/list.html.twig', ['records' => $records]);
    }

    /**
     * @Route("/wish/{id}", name="wish_detail", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function detail($id, EntityManagerInterface $emi): Response
    {
        $record = $emi->getRepository("App:Wish")->find($id);
        return $this->render('wish/detail.html.twig', ['record' => $record]);
    }

    /**
     * @Route("/wish/delete/{id}", name="wish_delete", requirements={"id":"\d+"})
     */
    public function delete($id)
    {
        $qb = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->delete('App:Wish', 'w')
            ->where('w.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        $qb->execute();
        return $this->redirectToRoute('main_home');
    }

}
