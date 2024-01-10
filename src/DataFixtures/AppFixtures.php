<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));   

        $transmission = ['traction','propulsion','intégrale']; // tableau de transmission
        for($i=1; $i<=30; $i++)
        {
            $ad = new Ad();
            $arrayCar = $faker->vehicleArray; // init d'un tableau pour récup des marques et modèle de véhciules cohérents 
            $brand = $arrayCar['brand'];
            $model = $arrayCar['model'];

            $MainImg = 'https://picsum.photos/seed/picsum/1000/350';
            $km = $faker->numberBetween(1000, 100000);
            $price = $faker->numberBetween(1000, 100000);
            $PrevOwners = $faker->numberBetween(1, 4);
            $Engine = $faker->numberBetween(1.0, 10.0);
            $Power = $faker->numberBetween(50, 300);
            $Fuel = $faker->vehicleFuelType;
            $FirstRelease = rand(1990, 2023);
            $Transmission = $faker->randomElement($transmission);
            $Description= $faker->paragraph(2);
            $Options= $faker->paragraph(2);

            $ad->setbrand($brand)
                ->setmodel($model)
                ->setMainImg($MainImg)
                ->setkm($km)
                ->setprice($price)
                ->setPrevOwners($PrevOwners)
                ->setEngine($Engine)
                ->setPower($Power)
                ->setFuel($Fuel)
                ->setFirstRelease($FirstRelease)
                ->setTransmission($Transmission)
                ->setDescription($Description)
                ->setOptions($Options);

            $manager->persist($ad);
        }
        $manager->flush();
    }
}