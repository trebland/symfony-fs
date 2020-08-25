<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Recipe;

class HomeController extends AbstractController
{
    /**
    * @Route("/", name="transition_home")
    */
    public function index(): Response
    {
        $recipes = $this->getDoctrine() 
        ->getRepository('App:Recipe') 
        ->findAll();
        
        return $this->render('default/homepage.html.twig', ['recipes' => $recipes]);
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
        ->findBy(
            ['category' => $slug]
        );
        
        return $this->render('recipes/recipe_category_view.html.twig', ['category' => $slug, 'recipes' => $recipes]);
    }
}