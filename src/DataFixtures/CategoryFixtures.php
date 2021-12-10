<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; $i++)
        {
            $category = new Category();

            $category->setName($faker->name())
            ->setDescription($faker->text(300));

            $manager->persist($category);
        }

        $manager->flush();
    }
}
