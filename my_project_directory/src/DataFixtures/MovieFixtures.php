<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\User;


class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 30) as $i) {
            $movie = new Movie();
            $movie->setTitle('Movie '.$i);
            $movie->setDescription('Description '.$i);
            $movie->setReleaseDate(new \DateTime());
            $movie->setDuration(rand(60,180));
            $movie->setOnline(rand(0,1));
            $movie->setCategory($this->getReference('category_'.rand(1,5)));
            $movie->addActor($this->getReference('actor_'.rand(1,9)));
            $manager->persist($movie); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('movie_'.$i, $movie); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ActorFixtures::class,
            UsersFixtures::class
        ];
    }
}
