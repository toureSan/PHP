<?php

namespace App\DataFixtures;
use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PatientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $names  = [
            ["Maka","Toure", "CH 123432334", "10.03.1993"],
            ["Amir", "Blear", "CH 123432334", "10.03.1997"],
        ]; 

        foreach ($names as $name) {
            $patient  = new Patient(); 
            $patient 
                ->setName {$name[0]}
                ->setprenom {$name[1]}
                ->setAvs_num {$name[2]}
                ->setBirthdate {$name[3]};
     
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
