<?php

namespace App\DataFixtures;

use App\Entity\Sweatshirt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SweatshirtFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $sweatshirtsData = [
            ['name' => 'Blackbelt', 'price' => 29,90 , 'highlight' => true, 'image' => 'sweatshirt1.jpeg'],
            ['name' => 'BlueBelt', 'price' => 29,90 , 'highlight' => false, 'image' => 'sweatshirt2.jpeg'],
            ['name' => 'Street', 'price' => 34,50 , 'highlight' => false, 'image' => 'sweatshirt3.jpeg'],
            ['name' => 'Pokeball', 'price' => 45, 'highlight' => true, 'image' => 'sweatshirt4.jpeg'],
            ['name' => 'PinkLady', 'price' => 29,90 , 'highlight' => false, 'image' => 'sweatshirt5.jpeg'],
            ['name' => 'Snow', 'price' => 32, 'highlight' => false, 'image' => 'sweatshirt6.jpeg'],
            ['name' => 'Greyback', 'price' => 28,50, 'highlight' => false, 'image' => 'sweatshirt7.jpeg'],
            ['name' => 'BlueCloud', 'price' => 45, 'highlight' => false, 'image' => 'sweatshirt8.jpeg'],
            ['name' => 'BornInUsa', 'price' =>  59,90 , 'highlight' => true, 'image' => 'sweatshirt9.jpeg'],
            ['name' => ' GreenSchool', 'price' => 42,20, 'highlight' => false, 'image' => 'sweatshirt10.jpeg'],
        ];

        foreach ($sweatshirtsData as $key => $data) {
            $sweatshirt = new Sweatshirt();
            $sweatshirt->setName($data['name']);
            $sweatshirt->setPrice($data['price']);
            $sweatshirt->setHighlight($data['highlight']);
            $sweatshirt->setImage($data['image']);
            
            $this->addReference('sweatshirt_' . $key, $sweatshirt);
            
            $manager->persist($sweatshirt);
        }

        $manager->flush();
    }
}
