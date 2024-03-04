<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use Faker;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));
        foreach (range(1, 40) as $i) {
            $movie = new Movie();
            $movie->setTitle($faker->unique()->movie());
            $movie->setDescription($faker->unique()->overview());
            $movie->setReleaseDate($faker->unique()->dateTimeBetween('-30 years', 'now'));
            $movie->setDuration(rand(60, 180));
            $movie->setOnline(rand(0, 1));
            $movie->setCategory($this->getReference('category_' . rand(1, 5)));
            $movie->addActor($this->getReference('actor_' . rand(1, 9)));
            $manager->persist($movie); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('movie_' . $i, $movie); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture
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
