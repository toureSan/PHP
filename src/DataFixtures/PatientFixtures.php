<?php

namespace App\DataFixtures;
use App\Entity\Patient;
//use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PatientFixtures extends Fixture //implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names  = [
            ["Anir","genre", "CH 123332334", "10.03.1992"],
            ["ferati", "avdoouli", "CH 121432334", "10.03.1994"],
            ["karim", "met", "CH 123532334", "10.03.1991"],
            ["Anir","genre", "CH 123332334", "10.03.1992"],
            ["ferati", "avdoouli", "CH 121432334", "10.03.1994"],
            ["karim", "met", "CH 123532334", "10.03.1991"],
            ["Anir","genre", "CH 123332334", "10.03.1992"],
            ["ferati", "avdoouli", "CH 121432334", "10.03.1994"],
            ["karim", "met", "CH 123532334", "10.03.1991"],
            ["ferati", "avdoouli", "CH 121432334", "10.03.1994"],
            ["generol", "deronavi", "CH 121402334", "10.03.1993"],
        
          
        ]; 

        foreach ($names as $name) {
         $patient = new Patient();

            $patient 
                ->setNom ($name[0])
                ->setPrenom ($name[1])
                ->setAvsNum ($name[2])
                ->setBirthdate (new \DateTime($name[3]))
                ;
     
                $manager->persist($patient);
            }
            $manager->flush();
        

     
    }
    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }
}
