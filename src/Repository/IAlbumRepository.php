<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 22:01
 */

namespace App\Repository;

use App\Entity\IAlbum;

/**
 * Interface IAlbumRepository
 * @package App\Repository
 *
 * @method IAlbum|null find($id, $lockMode = null, $lockVersion = null)
 * @method IAlbum|null findOneBy(array $criteria, array $orderBy = null)
 * @method IAlbum[]    findAll()
 * @method IAlbum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface IAlbumRepository
{
    /**
     * @param int $id
     * @return IAlbum|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAlbum(int $id): ?IAlbum;
}