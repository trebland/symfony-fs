<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{

    /**
     * @Route("/recipe", name="create_recipe")
     */
    public function createRecipe(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createRecipe(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $recipe = new Recipe();
        $recipe->setTitle('Burger');
        $recipe->setIngredients(['Lettuce','Burg']);

        // tell Doctrine you want to (eventually) save the Recipe (no queries yet)
        $entityManager->persist($recipe);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new recipe with id '.$recipe->getId());
    }
}
