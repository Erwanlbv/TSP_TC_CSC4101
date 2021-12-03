<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->LoadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$email,$plainPassword,$familyName,$role, $country]) {
            $user = new User();
            $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);
            $user->setFirstName($plainPassword);
            $user->setFamilyName($familyName);
            $user->setCountry($country);


            $roles = array();
            $roles[] = $role;
            $user->setRoles($roles);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData()
    {
        yield ['chris@localhost','chris', 'breton', 'ROLE_USER','FR' ];
        yield ['anna@localhost','anna', 'laroche', 'ROLE_ADMIN','FR'];

    }
}
