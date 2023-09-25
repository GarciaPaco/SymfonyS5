<?php

namespace App\Controller;

use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product_list')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_view')]
    public function viewProduct(string $id): Response
    {
        return $this->render('product/viewProduct.html.twig', [
            'id' => $id
        ]);
    }
    #[Route('/slug', name: 'app_slug_product')]
    public function slugProduct(
        Slugify $slugify,
    ): Response

    {
        $texte = $slugify->generateSlug('Wôrķšƥáçè ~~sèťtïñğš~~');
        dd($texte);
        return $this->render('product/slugProduct', [
        ]);
    }
}
