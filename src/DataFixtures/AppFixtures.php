<?php
declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\SchoolClass;
use App\Entity\Pupil;
use App\Entity\Teacher;
use App\Entity\PupilClass;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $classes = [];
        for ( $i = 65; $i < 65+6; $i++ ) {
            $class = new SchoolClass();
            $class->setSymbol(chr($i));
            $manager->persist($class);
            $manager->flush();
            $classes[] = [$class->getId(), $class->getSymbol()];
        }

        $teachers = [];
        $classIndex = 0;
        for ( $i = 1; $i <= 20; $i++ ) {
            $teacher = new Teacher();
            $teacher->setFirstName("Imie" . $i);
            $teacher->setLastName("Nauczyciel" . $i);
            if ( $i % 3 == 0 && $classIndex < 6 ) {
                $teacher->setTutorForClass($classes[$classIndex][0]);
                $classIndex += 1;
            }
            $manager->persist($teacher);
            $manager->flush();
            $teachers[] = $teacher->getId();
        }

        for ( $classIndex = 0; $classIndex < 6; $classIndex++ ) {
            for ($i = 1; $i <= 15 + $classIndex; $i++ ) {
                $pupil = new Pupil();
                $pupil->setFirstName("Imie" . $i);
                $pupil->setLastName("Uczen" . $i . "kl" . $classes[$classIndex][1]);
                if ($i % 2 == 0) {
                    $pupil->setSex('M');
                }
                else {
                    $pupil->setSex('F');
                }
                $manager->persist($pupil);
                $manager->flush();
                $pupilClass = new PupilClass();
                $pupilClass->setClass($classes[$classIndex][0]);
                $pupilClass->setPupil($pupil->getId());
                $pupilClass->setLanguageGroup(( $i <= 7 ) ? '1' : '2');
                $manager->persist($pupilClass);
            }
        }

        $manager->flush();
    }
}
