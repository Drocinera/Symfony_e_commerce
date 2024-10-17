<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            ['email' => 'user1@example.com', 'password' => 'userpassword1', 'delivery_address' => '123 Main St', 'isVerified' => true],
            ['email' => 'user2@example.com', 'password' => 'userpassword2', 'delivery_address' => '456 Oak St', 'isVerified' => false],
            ['email' => 'user3@example.com', 'password' => 'userpassword3', 'delivery_address' => '789 Pine St', 'isVerified' => true],
            ['email' => 'user4@example.com', 'password' => 'userpassword4', 'delivery_address' => '321 Maple St', 'isVerified' => false],
            ['email' => 'user5@example.com', 'password' => 'userpassword5', 'delivery_address' => '654 Elm St', 'isVerified' => true],
        ];

        foreach ($usersData as $key => $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setRoles(['ROLE_USER']);
            $user->setDeliveryAddress($data['delivery_address']);
            $user->setVerified($data['isVerified']);
            
            $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);

            $this->addReference('user_' . $key, $user);
        }

        $manager->flush();
    }
}
