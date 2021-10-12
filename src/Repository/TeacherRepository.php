<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Teacher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teacher[]    findAll()
 * @method Teacher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teacher::class);
    }

    /**
     * @return Teacher[] Returns an array of Teacher objects
     */
    public function findTutors() : array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT t.id, t.firstName, t.lastName, sc.symbol AS tutorForClass
            FROM App\Entity\Teacher t 
            JOIN App\Entity\SchoolClass sc WITH t.tutorForClass = sc.id
            ');
        return $query->getResult();
    }
}
