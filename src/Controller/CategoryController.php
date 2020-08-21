<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="create_category")
     */
    public function createCategory(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createCategory(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle('Breakfast');

        // tell Doctrine you want to (eventually) save the Category (no queries yet)
        $entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new category with id '.$category->getId());
    }

    // /**
    //  * @Route("/category/show", name="show_category")
    //  */
    // public function show_category(): Response
    // {
    //     // you can fetch the EntityManager via $this->getDoctrine()
    //     // or you can add an argument to the action: createCategory(EntityManagerInterface $entityManager)
    //     $entityManager = $this->getDoctrine()->getManager();

    //     $category = new Category();
    //     $category->setTitle('Breakfast');

    //     // tell Doctrine you want to (eventually) save the Category (no queries yet)
    //     $entityManager->persist($category);

    //     // actually executes the queries (i.e. the INSERT query)
    //     $entityManager->flush();

    //     return new Response('Saved new category with id '.$category->getId());
    // }

    public function categories()
    {
        // get the recent articles somehow (e.g. making a database query)
        $categories = ['breakfast', 'lunch', 'dinner'];

        return $this->render('recipes/_categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
