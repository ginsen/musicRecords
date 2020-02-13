<?php

namespace App\Repository;

use App\Entity\Artist;
use App\Entity\IArtist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method IArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method IArtist[]    findAll()
 * @method IArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository implements IArtistRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);
    }


    /**
     * @inheritdoc
     */
    public function findOneArtist(): ?IArtist
    {
        $dql = 'SELECT a FROM App:Artist a';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }


    /**
     * @inheritdoc
     */
    public function findArtist(int $id): ?IArtist
    {
        $dql = 'SELECT ar
                FROM App:Artist ar
                LEFT JOIN App:AlbumArtist alar WITH ar.id = alar.artist
                WHERE ar.id = :id';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
