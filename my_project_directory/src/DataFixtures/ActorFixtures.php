<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use Faker;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        foreach (range(1, 9) as $i) {
            $fullname = $faker->unique()->actor();
            $firstName = substr($fullname, 0, strpos($fullname, ' '));
            $lastName = substr($fullname, strpos($fullname, ' ')+1);
            $actor = new Actor();
            $actor->setFirstName($firstName);
            $actor->setLastName($lastName);
            $actor->setActorOrigine($this->getReference('nationalite_'.rand(1,9)));
            $manager->persist($actor); // "expose" l'objet à Doctrine pour qu'il soit enregistré en BDD
            $this->addReference('actor_'.$i, $actor); // permet de garder une référence à l'objet pour le récupérer dans une autre fixture

        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            NationaliteFixtures::class,
        ];
    }
}
