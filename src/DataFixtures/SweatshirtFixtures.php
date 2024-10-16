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
            ['name' => 'Blackbelt', 'price' => 29,90 , 'highlight' => true, 'image' => 'sweatshirt1.jpg'],
            ['name' => 'BlueBelt', 'price' => 29,90 , 'highlight' => false, 'image' => 'sweatshirt2.jpg'],
            ['name' => 'Street', 'price' => 34,50 , 'highlight' => false, 'image' => 'sweatshirt3.jpg'],
            ['name' => 'Pokeball', 'price' => 45, 'highlight' => true, 'image' => 'sweatshirt4.jpg'],
            ['name' => 'PinkLady', 'price' => 29,90 , 'highlight' => false, 'image' => 'sweatshirt5.jpg'],
            ['name' => 'Snow', 'price' => 32, 'highlight' => false, 'image' => 'sweatshirt6.jpg'],
            ['name' => 'Greyback', 'price' => 28,50, 'highlight' => false, 'image' => 'sweatshirt7.jpg'],
            ['name' => 'BlueCloud', 'price' => 45, 'highlight' => false, 'image' => 'sweatshirt8.jpg'],
            ['name' => 'BornInUsa', 'price' =>  59,90 , 'highlight' => true, 'image' => 'sweatshirt9.jpg'],
            ['name' => ' GreenSchool', 'price' => 42,20, 'highlight' => false, 'image' => 'sweatshirt10.jpg'],
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
