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
     * @Route("/recipe/new", methods="GET|POST", name="create_recipe")
     */
    public function new(Request $request, string $title = "", string $category = "", string $description = "", array $ingredients = [""]): Response
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

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Recipe (no queries yet)
            $entityManager->persist($recipe);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirect("/");
        }

        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * The slug will act as the id when querying the db
     * @Route("/recipe/edit/{slug}", methods="GET|POST", name="edit_recipe")
     */
    public function edit(Request $request, string $slug): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Original Recipe --
        // .. The next few lines are used to identify the existence of the item
        // .. to ensure we're able to modify it.
        $recipe = $entityManager->getRepository(Recipe::class)->find($slug);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            // In edits, this is unnecessary as Doctrine is already watching the entity
            // .. leaving it so the comment will help later understandings
            $entityManager->persist($recipe);

            // actually executes the queries (i.e. the UPDATE query)
            $entityManager->flush();

            return $this->redirect("/");
        }

        return $this->render('recipe/edit.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }

    /**
     * The slug will act as the id when querying the db
     * @Route("/recipe/delete/{slug}", methods="POST", name="delete_recipe")
     */
    public function delete(string $slug): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Original Recipe --
        // .. The next few lines are used to identify the existence of the item
        // .. to ensure we're able to modify it.
        $recipe = $entityManager->getRepository(Recipe::class)->find($slug);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        // In edits, this is unnecessary as Doctrine is already watching the entity
        // .. leaving it so the comment will help later understandings
        $entityManager->remove($recipe);

        // actually executes the queries (i.e. the DELETE query)
        $entityManager->flush();

        return $this->redirect("/");
    }

    /**
     * The slug will act as the id when querying the db
     * @Route("/recipe/{slug}", methods="GET", name="view_recipe")
     */
    public function view(string $slug): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Original Recipe --
        // .. The next few lines are used to identify the existence of the item
        // .. to ensure we're able to modify it.
        $recipe = $entityManager->getRepository(Recipe::class)->find($slug);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        return $this->render('recipe/view.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
