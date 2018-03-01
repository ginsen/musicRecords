<?php
/**
 * Created by PhpStorm.
 * User: gin
 * Date: 28/02/18
 * Time: 15:37
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrinePersistLayer
 * @package App\Service
 */
class DoctrinePersistLayer implements IPersistLayer
{
    /** @var EntityManagerInterface */
    protected $em;


    /**
     * DoctrinePersistLayer constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @inheritdoc
     */
    public function save($entity, bool $flush = true): void
    {
        $this->em->persist($entity);

        if ($flush) {
            $this->em->flush();
        }
    }


    /**
     * @inheritdoc
     */
    public function remove($entity, bool $flush = true): void
    {
        $this->em->remove($entity);

        if ($flush) {
            $this->em->flush();
        }
    }
}
