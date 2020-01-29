<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface $passwordEncoder */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('user1')
            ->setPassword($this->passwordEncoder->encodePassword($user1, 'pass1'))
            ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('user2')
            ->setPassword($this->passwordEncoder->encodePassword($user2, 'pass2'))
            ->setRoles(['ROLE_USER'])
        ;
        $manager->persist($user2);

        $manager->flush();
    }
}
