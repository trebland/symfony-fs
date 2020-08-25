<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Psr\Log\LoggerInterface;

use App\Entity\Recipe;

/**
 * Navigation controller
 * Takes route feedback and points to the appropriate page that isn't entity specific
 */
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
     * The slug is our category
    * @Route("/category/{slug}", name="show_category_recipe")
    */
    public function showCategoryRecipe(string $slug): Response
    {
        $recipes = $this->getDoctrine() 
        ->getRepository('App:Recipe') 
        ->findBy(
            ['category' => strtolower($slug)],
            ['id' => 'DESC'],
        );
        
        return $this->render('recipes/recipe_category_view.html.twig', ['category' => ucfirst($slug), 'recipes' => $recipes]);
    }

    /**
     * The slug acts as our search criteria
    * @Route("/search/{slug}", name="show_search_recipes")
    */
    public function showSearchRecipe(string $slug): Response
    {
        $recipes = $this->getDoctrine() 
            ->getRepository('App:Recipe') 
            ->searchFor($slug);
        
        return $this->render('recipes/recipe_category_view.html.twig', ['category' => "Searched: ".$slug, 'recipes' => $recipes]);
    }
}