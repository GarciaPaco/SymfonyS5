<?php

namespace App\DataFixtures;

use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Génère un tableau dans la variable pays qui contient dix origines
        $pays = ['France', 'Allemagne', 'Italie', 'Espagne', 'Portugal', 'Belgique', 'Suisse', 'Angleterre', 'Pays-Bas', 'Autriche'];
        foreach (range(1, 9) as $i) {
            $nationalite = new Nationalite();
            $nationalite->setOrigine($pays[$i]);
            $manager->persist($nationalite);
            $this->addReference('nationalite_'.$i, $nationalite);
        }

        $manager->flush();
    }
}
