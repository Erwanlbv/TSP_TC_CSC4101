<?php

namespace App\DataFixtures;

use App\Entity\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Region;
use App\Entity\Room;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class AppFixtures extends Fixture
{
    public const IDF_REGION_REFERENCE = 'idf-region';
    public const BR_REGION_REFERENCE = 'bre-region';
    public const RA_REGION_REFERENCE = 'Rha-region';

    public function load(ObjectManager $manager)
    {

        $region = new Region();
        $region->setCountry("FR");
        $region->setName("Ile de France");
        $region->setPresentation("La région française capitale");
        $manager->persist($region);

        $region2 = new Region();
        $region2->setCountry("FR");
        $region2->setName("Bretagne");
        $region2->setPresentation("Très belle région");
        $manager->persist($region2);

        $region3 = new Region();
        $region3->setCountry("FR");
        $region3->setName("Rhône-Alpes");
        $region3->setPresentation("Région de la meilleure ville de France");
        $manager->persist($region3);


        $manager->flush();
        // Une fois l'instance de Region sauvée en base de données,
        // elle dispose d'un identifiant généré par Doctrine, et peut
        // donc être sauvegardée comme future référence.
        $this->addReference(self::IDF_REGION_REFERENCE, $region);
        $this->addReference(self::BR_REGION_REFERENCE, $region2);
        $this->addReference(self::RA_REGION_REFERENCE, $region3);


        $owner = new Owner();
        $owner->setFirstname('Dan');
        $owner->setFamilyName('Brown');
        $owner->setCountry('US');
        $owner->setAddress('55 5th Avenue de New York, NY 10003,  États-Unis');

        $manager->persist($owner);
        $manager->flush();

        $room = new Room();
        $room->setSummary("Beau poulailler ancien à Évry");
        $room->setDescription("très joli espace sur paille");
        //$room->addRegion($region);
        // On peut plutôt faire une référence explicite à la référence
        // enregistrée précédamment, ce qui permet d'éviter de se
        // tromper d'instance de Region :
        $room->addRegion($this->getReference(self::IDF_REGION_REFERENCE));
        $room->setOwner($owner);
        $room->setCapacity(5);
        $room->setPrice(500.0);
        $room->setAddress('5 rue Charles Fourier, 91000 Évry ');


        $manager->persist($room);



    }
}
