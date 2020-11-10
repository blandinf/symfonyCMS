<?php


namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($count = 0; $count < 10; $count++) {
            $name = "Category";
            $category = new Category();
            $category->setName($name . " - " . $count);
            $manager->persist($category);
        }

        $manager->flush();
    }
}