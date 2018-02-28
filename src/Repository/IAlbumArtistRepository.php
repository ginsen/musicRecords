<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 21:57
 */

namespace App\Repository;

use App\Entity\IAlbumArtist;

/**
 * Interface IAlbumArtistRepository
 * @package App\Repository
 */
interface IAlbumArtistRepository
{
    /**
     * @param int $id
     * @return IAlbumArtist|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAlbumArtist(int $id): ?IAlbumArtist;
}