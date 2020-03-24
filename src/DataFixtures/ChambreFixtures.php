<?php

namespace App\DataFixtures;

use App\entity\Chambre; 
use App\Repository\HospitalRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ChambreFixtures extends Fixture implements DependentFixtureInterface
{
    private $hospitalRepository; 

    public function __construct(HospitalRepository $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }

    public function load(ObjectManager $manager)
    {
   
        $hospitals = $this->hospitalRepository->findAll();

        foreach($hospitals as $hospital){
            $chambreToCreate = rand(3,8); 
           
            for($i =1; $i<= $chambreToCreate; $i++){
                $chambre = new Chambre(); 
                $chambre->setNom("Chambre no* : ".(rand(100, 1000))); 
                $chambre->setHospital($hospital); 
                $chambre->setCapacite(rand(100,1000));
              
                $manager->persist($chambre);
            }
        }
        $manager->flush();
        
    }
    public function getDependencies()
    {
        return [
            HospitalFixtures::class
        ];
    }
}
