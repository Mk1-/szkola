<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Pupil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pupil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pupil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pupil[]    findAll()
 * @method Pupil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PupilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pupil::class);
    }

     /**
      * @return Pupil[] Returns an array of Pupil objects
      */
    public function findByClassAssigned(string $classSymbol) : array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT p 
            FROM App\Entity\Pupil p 
            JOIN App\Entity\PupilClass pc WITH p.id = pc.pupil
            JOIN App\Entity\SchoolClass sc WITH pc.class = sc.id AND sc.symbol = :symbol
            ORDER BY p.sex ASC
            ');
        $query->setParameter('symbol', $classSymbol);
        return $query->getResult();
    }

    /**
     * @return Pupil[] Returns an array of Pupil objects
     */
    public function findByClassAndLaguageGroup(string $classSymbol, string $languageGroupSymbol) : array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT p 
            FROM App\Entity\Pupil p 
            JOIN App\Entity\PupilClass pc WITH p.id = pc.pupil AND pc.languageGroup = :group
            JOIN App\Entity\SchoolClass sc WITH pc.class = sc.id AND sc.symbol = :symbol
            ');
        $query->setParameters(['symbol'=>$classSymbol, 'group'=>$languageGroupSymbol]);
        return $query->getResult();
    }

}
