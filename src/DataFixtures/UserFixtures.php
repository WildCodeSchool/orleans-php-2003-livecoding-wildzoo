<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail('user' . $i . '@wildzoo.com');
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'user' . $i));
            $manager->persist($user);
        }

        $admin = new User();
        $admin->setFirstname('John');
        $admin->setLastname('Doe');
        $admin->setEmail('admin@wildzoo.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $superAdmin = new User();
        $superAdmin->setFirstname('Bilbo');
        $superAdmin->setLastname('Baggins');
        $superAdmin->setEmail('superadmin@wildzoo.com');
        $superAdmin->setPassword($this->passwordEncoder->encodePassword($superAdmin, 'sauron'));
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($superAdmin);

        $manager->flush();
    }
}
