<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 22:10
 */

namespace App\Repository;

use App\Entity\IRole;

/**
 * Interface IRoleRepository
 * @package App\Repository
 */
interface IRoleRepository
{
    /**
     * @return IRole|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneRole(): ?IRole;
}
