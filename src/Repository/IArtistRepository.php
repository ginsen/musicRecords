<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 22:05
 */

namespace App\Repository;

use App\Entity\IArtist;

/**
 * Interface IArtistRepository
 * @package App\Repository
 *
 * @method IArtist|null find($id, $lockMode = null, $lockVersion = null)
 * @method IArtist|null findOneBy(array $criteria, array $orderBy = null)
 * @method IArtist[]    findAll()
 * @method IArtist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface IArtistRepository
{
    /**
     * @return IArtist|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneArtist(): ?IArtist;

    /**
     * @param int $id
     * @return IArtist|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findArtist(int $id): ?IArtist;
}