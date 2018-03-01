<?php

namespace App\Repository;

use App\Entity\AlbumArtist;
use App\Entity\IAlbumArtist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IAlbumArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method IAlbumArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method IAlbumArtist[]    findAll()
 * @method IAlbumArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumArtistRepository extends ServiceEntityRepository implements IAlbumArtistRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AlbumArtist::class);
    }


    /**
     * @inheritdoc
     */
    public function findAlbumArtist(int $id): ?IAlbumArtist
    {
        $dql = 'SELECT aa
                FROM App:AlbumArtist aa
                JOIN App:Album al WITH al.id = aa.album
                JOIN App:Artist ar WITH ar.id = aa.artist
                JOIN App:Role ro WITH ro.id = aa.role
                WHERE aa.id = :id';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
