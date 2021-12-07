<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'program_id' => '0',
            'number' => 1,
            'year' => 2015,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '0',
            'number' => 2,
            'year' => 2016,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '1',
            'number' => 1,
            'year' => 2017,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '2',
            'number' => 1,
            'year' => 2018,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '3',
            'number' => 1,
            'year' => 2019,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '3',
            'number' => 2,
            'year' => 2019,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '3',
            'number' => 3,
            'year' => 2019,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
        [
            'program_id' => '4',
            'number' => 1,
            'year' => 2019,
            'description' => 'BLABLABLABLABLABLABLABLABLA',
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $season) {
            $newSeason = new Season();
            $newSeason->setNumber($season['number']);
            $newSeason->setYear($season['year']);
            $newSeason->setDescription($season['description']);
            $newSeason->setProgram($this->getReference('program_' . $season['program_id']));
            $manager->persist($newSeason);
            $this->setReference('season_' . $key, $newSeason);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
