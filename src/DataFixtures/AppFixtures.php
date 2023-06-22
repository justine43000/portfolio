<?php

namespace App\DataFixtures;

use App\Entity\Actualite;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\Projet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $updatedAt = $faker->dateTimeBetween('-6 months', 'now');

        $userAdmin = new User();
        $userAdmin->setPrenom('Justine');
        $userAdmin->setNom('Prevot');
        $userAdmin->setEmail("justine.prevot43@gmail.com");
        $userAdmin->setRoles(["ROLE_ADMIN"]);
        $userAdmin->setPassword($this->userPasswordHasher->hashPassword($userAdmin, "Prisca020915$"));

        $manager->persist($userAdmin);
        $manager->flush();
        // create 20 products! Bam!

        for ($i = 0; $i < 5; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setPrenom($faker->firstName());
            $commentaire->setNom($faker->lastName());
            $commentaire->setDate($faker->dateTime($updatedAt));
            $commentaire->setMessage($faker->text(350));
            $manager->persist($commentaire);
            $manager->flush();
        }

        for ($i = 0; $i < 5; $i++) {
            $actualite = new Actualite();
            $actualite->setNom($faker->lastName());
            $actualite->setDate($faker->dateTime($updatedAt));
            $actualite->setLieu($faker->city());
            $actualite->setDescription($faker->text(350));
            $manager->persist($actualite);
            $manager->flush();
        }

        for ($i = 0; $i < 5; $i++) {
            $projet = new Projet();
            $projet->setNom($faker->lastName());
            $projet->setDate($faker->dateTime($updatedAt));
            $projet->setDifficultes($faker->text(250));
            $projet->setUser($userAdmin);
            $manager->persist($projet);
            $manager->flush();

            for ($c = 0; $c < 2; $c++) {
                $categorie = new Categorie();
                $categorie->setLabel($faker->word());
                $projet->addCategorie($categorie);
                $manager->persist($categorie);
                $manager->flush();
            }
        }
    }
}
