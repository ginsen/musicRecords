<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\IAlbum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IAlbum|null find($id, $lockMode = null, $lockVersion = null)
 * @method IAlbum|null findOneBy(array $criteria, array $orderBy = null)
 * @method IAlbum[]    findAll()
 * @method IAlbum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends ServiceEntityRepository implements IAlbumRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Album::class);
    }


    /**
     * @inheritdoc
     */
    public function findAlbum(int $id): ?IAlbum
    {
        return $this->createQueryBuilder('al')
            ->select('al', 'alar', 'ar', 'ro')
            ->leftJoin('al.albumArtists', 'alar')
            ->leftJoin('alar.artist', 'ar')
            ->leftJoin('alar.role', 'ro')
            ->where('al.id = :album_id')->setParameter('album_id', $id)
            ->orderBy('alar.position', 'ASC')
            ->setParameter('album_id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
