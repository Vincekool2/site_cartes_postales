<?php

declare(strict_types=1);

namespace App\Controller\Public;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/categories', 'list_categories')]
    public function listCategories(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('public/page/category/list_categories.html.twig',[
            'categories' => $categories
        ]);
    }


    #[Route('/categories/{id}', 'show_category')]
    public function showCategory(int $id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            $html404 = $this->renderView('public/page/404.html.twig');
            return new Response($html404, 404);
        }

        return $this->render('public/page/category/show_category.html.twig', [
            'category' => $category
        ]);
    }

}