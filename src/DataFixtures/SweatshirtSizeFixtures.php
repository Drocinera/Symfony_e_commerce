<?php

namespace App\DataFixtures;

use App\Entity\SweatshirtSize;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SweatshirtSizeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Tailles à associer à chaque sweatshirt (les clés correspondent aux sweatshirts dans l'ordre de création)
        $sizesData = [
            0 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            1 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            2 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            3 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            4 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            5 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            6 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            7 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            8 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
            9 => [['size' => 'XS', 'stock' => 2], ['size' => 'S', 'stock' => 2], ['size' => 'M', 'stock' => 2], ['size' => 'L', 'stock' => 2], ['size' => 'XL', 'stock' => 2]],
        ];

        // Boucle sur les sweatshirts et création des tailles associées
        foreach ($sizesData as $sweatshirtIndex => $sizes) {
            $sweatshirt = $this->getReference('sweatshirt_' . $sweatshirtIndex);

            foreach ($sizes as $sizeData) {
                $sweatshirtSize = new SweatshirtSize();
                $sweatshirtSize->setSize($sizeData['size']);
                $sweatshirtSize->setStock($sizeData['stock']);
                $sweatshirtSize->setSweatshirt($sweatshirt);

                $manager->persist($sweatshirtSize);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SweatshirtFixtures::class,
        ];
    }
}
