<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish/add", name="wish_add")
     */
    public function add(EntityManagerInterface $emi, Request $request)
    {
        $wish = new Wish();
        $wish->setIsPublished(true);
        $wish->setDateCreated(new DateTime());

        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            $emi->persist($wish);
            $emi->flush();
            $this->addFlash('success', 'The idea have been saved !');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }
        return $this->render('wish/add.html.twig', ['wishForm' => $wishForm->createView()]);
    }

    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        $records = $wishRepository->findBy(
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
        if (!$record) {
            throw $this->createNotFoundException('Idea not found');
        }

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
