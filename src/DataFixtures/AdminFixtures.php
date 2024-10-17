<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $adminsData = [
            ['email' => 'admin1@example.com', 'password' => 'adminpassword1'],
            ['email' => 'admin2@example.com', 'password' => 'adminpassword2'],
        ];

        foreach ($adminsData as $key => $data) {
            $admin = new Admin();
            $admin->setEmail($data['email']);
            $admin->setRoles(['ROLE_ADMIN']);
            
            $hashedPassword = $this->passwordHasher->hashPassword($admin, $data['password']);
            $admin->setPassword($hashedPassword);

            $manager->persist($admin);

            $this->addReference('admin_' . $key, $admin);
        }

        // Enregistrer en base de données
        $manager->flush();
    }
}
