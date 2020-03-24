<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Hospital;

class HospitalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $names = [

            [ 'hopital la tour', "254 routes des fayards", "129v","Versoix", "Suisse"],
            [ 'hopital tour', "254 routes des fayards", "19v","Br", "Bruxelle"],
            [ 'hopital mirandoline', "254 routes des Riandole", "129v","Geneve", "Suisse"],
            [ 'hopital Lausanne', "254 routes des Lausanne", "29v","Geneve", "Suisse"],
            [ 'hopital Zurich', "254 routes de Zurich", "9v","Geneve", "Suisse"],
        ];

        foreach ($names as $name){
            $hospital = new Hospital(); 
            
            $hospital 
                ->setNom($name[0])
                ->setAdresse($name[1])
                ->setPostal($name[2])
                ->setVille($name[3])
                ->setPostal($name[4])
                ; 
                $manager->persist($hospital); 

        }
        $manager->flush(); 
        
    }
    
}
