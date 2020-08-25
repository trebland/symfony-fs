<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Recipe;

class HomeController extends AbstractController
{
    /**
    * @Route("/login", name="transition_home")
    */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('home.html.twig', [
            'number' => $number,
        ]);
    }

    
    /**
    * @Route("/create-recipe", name="show_create_recipe")
    */
    public function show_create_recipe(int $ingredients = 1): Response
    {
        return $this->render('recipes/add.html.twig', ['ingredients' => $ingredients]);
    }

    /**
    * @Route("/edit-recipes", name="show_edit_recipes")
    */
    public function show_edit_recipe(): Response
    {
        return $this->render('recipes/edit.html.twig');
    }

    /**
    * @Route("/category/{slug}", name="show_category_recipe")
    */
    public function show_category_recipe(string $slug): Response
    {
        $recipes = $this->getDoctrine() 
        ->getRepository('App:Recipe') 
        ->findAll();
        
        return $this->render('recipes/recipe_category_view.html.twig', ['category' => $slug, 'recipes' => $recipes]);
    }
}