<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * No category creation yet exists,
 * therefore there is no constructor here.
 * 
 * If I feel the project needs to be developed further then I will enable custom categorization based on user input.
 */
class CategoryController extends AbstractController
{
    public function showCategories(): Response
    {
        // Static set of articles
        $categories = ['Breakfast', 'Lunch', 'Dinner'];

        return $this->render('recipes/_categories.html.twig', [
            'categories' => $categories
        ]);
    }
}
