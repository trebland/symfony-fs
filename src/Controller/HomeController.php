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
    * @Route("/category/{slug}", name="show_category_recipe")
    */
    public function show_category_recipe(string $slug): Response
    {
        $recipes = $this->getDoctrine() 
        ->getRepository('App:Recipe') 
        ->findBy(
            ['category' => strtolower($slug)],
            ['id' => 'DESC'],
        );
        
        return $this->render('recipes/recipe_category_view.html.twig', ['category' => ucfirst($slug), 'recipes' => $recipes]);
    }
}