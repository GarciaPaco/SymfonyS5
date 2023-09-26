<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      // Génère moi 5 objets Category fictifs
       foreach (range(1, 5) as $i) {
            $category = new Category();
            $category->setName('Category '.$i);
            $manager->persist($category); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('category_'.$i, $category); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture
        }

        $manager->flush();
    }
}
