<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:08
 */

namespace App\UseCase;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PersistEntityUseCase
 * @package App\UseCase
 */
class PersistEntityUseCase
{
    /** @var EntityManagerInterface */
    protected $em;


    /**
     * NewAlbumUseCase constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @param object $entity
     */
    public function execute(object $entity): void
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
}
