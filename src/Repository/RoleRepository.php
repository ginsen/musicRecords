<?php

namespace App\Repository;

use App\Entity\IRole;
use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method IRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method IRole[]    findAll()
 * @method IRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository implements IRoleRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }


    /**
     * @return IRole|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneRole(): ?IRole
    {
        $dql = 'SELECT r FROM App:Role r';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }
}
