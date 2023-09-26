<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie
;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 10) as $i) {
            $movie = new Movie();
            $movie->setTitle('Movie '.$i);
            $movie->setDescription('Description '.$i);
            $movie->setReleaseDate(new \DateTime());
            $movie->setDuration(rand(60,180));
            $movie->setCategory($this->getReference('category_'.rand(1,5)));
            $manager->persist($movie); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('movie_'.$i, $movie); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
