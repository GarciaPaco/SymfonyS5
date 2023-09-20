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

    #[Route('/product/{id</d+>}', name: 'app_product_view')] // regex pour id qui force un int
    public function viewProduct(int $id): Response
    {
        return $this->render('product/viewProduct.html.twig', [
            'id' => $id
        ]);
    }
    #[Route('/product/slug', name: 'app_slug_product')]
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
