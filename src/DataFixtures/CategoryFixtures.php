<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        foreach (range(1, 20) as $i) {
            $category = new Category();
            $category->setName($faker->unique()->movieGenre());
            $manager->persist($category); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('category_' . $i, $category); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture
        }

        $manager->flush();
    }
}
