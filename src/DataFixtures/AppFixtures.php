<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $customer = new User();
        $customer->setFullName($faker->name);
        $customer->setEmail('customer@example.com');
        $customer->setPassword($this->passwordHasher->hashPassword($customer, 'password'));
        $customer->setIsActive(true);
        $customer->setRoles(['ROLE_CUSTOMER']);
        $manager->persist($customer);

        $supplier = new User();
        $supplier->setFullName($faker->name);
        $supplier->setEmail('supplier@example.com');
        $supplier->setPassword($this->passwordHasher->hashPassword($supplier, 'password'));
        $supplier->setIsActive(true);
        $supplier->setRoles(['ROLE_SUPPLIER']);
        $manager->persist($supplier);

        $admin = new User();
        $admin->setFullName($faker->name);
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $admin->setIsActive(true);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
