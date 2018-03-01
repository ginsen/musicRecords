<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:08
 */

namespace App\UseCase;

use App\Service\IPersistLayer;

/**
 * Class RemoveEntityUseCase
 * @package App\UseCase
 */
class RemoveEntityUseCase
{
    /** @var IPersistLayer */
    protected $persistLayer;


    /**
     * RemoveEntityUseCase constructor.
     *
     * @param IPersistLayer $persistLayer
     */
    public function __construct(IPersistLayer $persistLayer)
    {
        $this->persistLayer = $persistLayer;
    }


    /**
     * Remove entity object.
     *
     * @param object $entity
     */
    public function execute($entity): void
    {
        $this->persistLayer->remove($entity);
    }
}
