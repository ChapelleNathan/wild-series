<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        foreach (SeasonFixtures::SEASONS as $key => $season) {
            for ($i = 1; $i <= 30; $i++) {
                $episode = new Episode();
                $episode->setTitle('BLALALLA');
                $episode->setNumber($i);
                $episode->setSynopsis('BLALALALLALALALLALLALALALLALALALLALALLALALALA');
                $episode->setSeason($this->getReference('season_' . $key));
                $manager->persist($episode);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}
