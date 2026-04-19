<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use App\Entity\Salle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConcertFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 🎭 Salle complète (IMPORTANT)
        $salle = new Salle();
        $salle->setNom("Salle Zenith");
        $salle->setCapacite(500);
        $salle->setAdresse("1 Rue de Paris");
        $salle->setVille("Paris");

        $manager->persist($salle);

        // 🎸 Concert 1
        $concert1 = new Concert();
        $concert1->setTitre("Rock Festival");
        $concert1->setDate(new \DateTime("2026-06-10"));
        $concert1->setPrix(49.99);
        $concert1->setDescription("Concert rock incroyable");
        $concert1->setNbPlaces(500);
        $concert1->setSalle($salle);

        $manager->persist($concert1);

        // 🎷 Concert 2
        $concert2 = new Concert();
        $concert2->setTitre("Jazz Night");
        $concert2->setDate(new \DateTime("2026-07-01"));
        $concert2->setPrix(29.99);
        $concert2->setDescription("Soirée jazz relax");
        $concert2->setNbPlaces(300);
        $concert2->setSalle($salle);

        $manager->persist($concert2);

        $manager->flush();
    }
}