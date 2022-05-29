<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\City;
use App\Entity\SubCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($k = 1; $k < 5; $k++) {
            $customer = new User();
            $customer->setFullName($faker->name);
            $customer->setEmail('customer' . $k . '@example.com');
            $customer->setPassword($this->passwordHasher->hashPassword($customer, 'password'));
            $customer->setIsActive(true);
            $customer->setRoles(['ROLE_CUSTOMER']);
            $manager->persist($customer);
        }

        for ($l = 1; $l < 5; $l++) {
            $supplier = new User();
            $supplier->setFullName($faker->name);
            $supplier->setEmail('supplier' . $l . '@example.com');
            $supplier->setPassword($this->passwordHasher->hashPassword($supplier, 'password'));
            $supplier->setIsActive(true);
            $supplier->setRoles(['ROLE_SUPPLIER']);
            $manager->persist($supplier);
        }
        $admin = new User();
        $admin->setFullName($faker->name);
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $admin->setIsActive(true);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $cities = ['Ariana', 'Béja', 'Ben Arous', 'Bizerte', 'Gabès', 'Gafsa', 'Jendouba', 'Kairouan', 'Kasserine', 'Kebili', 'Kef', 'Mahdia', 'Manouba', 'Medenine', 'Monastir', 'Nabeul', 'Sfax', 'Sidi Bouzid', 'Siliana', 'Sousse', 'Tataouine', 'Tozeur', 'Tunis', 'Zaghouan'];
        foreach ($cities as $city) {
            $city = (new City())->setName($city);
            $manager->persist($city);
        }
        for ($i = 0; $i < 10; $i++) {
            $category = (new Category())->setName($faker->company);
            $manager->persist($category);
            for ($j = 0; $j < 7; $j++) {
                $subCategory = (new SubCategory())->setName($faker->name)->setCategory($category);
                $manager->persist($subCategory);
            }
        }


        $manager->flush();
    }
}
