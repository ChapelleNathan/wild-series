<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;
use Faker\Factory;
use DateTime;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        [
            'name' => 'Andrew Lincoln',
            'picture' => 'andrew-lincoln-61d2d4ff5abb9884458427.jpg'
        ],
        [
            'name' => 'Norman Reedus',
            'picture' => 'norman-reedus-61d2d506189cf851264822.jpg'
        ],
        [
            'name' => 'Lauren Cohan',
            'picture' => 'lauren-cohan-61d2d50d13be7039008939.webp'
        ],
        [
            'name' => 'Jeffrey Dean Morgan',
            'picture' => 'jeffrey-dean-morgan-61d2d51692195156497744.jpg'
        ],
        [
            'name' => 'Chandler Riggs',
            'picture' => 'chandler-riggs-61d2d51f4dd23614122173.jpg'
        ],
    ];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        foreach (self::ACTORS as $key => $actor) {
            $newActor = new Actor();
            $newActor->setName($actor['name']);
            $newActor->setPicture($actor['picture']);
            $manager->persist($newActor);
            $this->addReference('actor_' . $key, $newActor);
            $newActor->setUpdatedAt(new DateTime('now'));
        }
        $manager->flush();
    }
}
