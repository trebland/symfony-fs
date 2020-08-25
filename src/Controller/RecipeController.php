<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{

    /**
     * @Route("/recipe", methods="GET|POST", name="create_recipe")
     */
    public function new(Request $request, string $title = "", string $category = "", string $description = "", array $ingredients = [""], int $numIngredients = 1): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createRecipe(EntityManagerInterface $entityManager)
        $recipe = new Recipe();
        $recipe->setTitle($title);
        $recipe->setCategory($category);
        $recipe->setDescription($description);
        $recipe->setIngredients($ingredients);

        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($request->isMethod('post'))
        {
            $entityManager = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Recipe (no queries yet)
            $entityManager->persist($recipe);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return new Response('Saved new recipe with id '.$recipe->getId());
        }

        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
