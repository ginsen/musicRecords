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

    /** @var object */
    protected $entity;


    /**
     * RemoveEntityUseCase constructor.
     *
     * @param IPersistLayer $persistLayer
     * @param object        $entity
     */
    public function __construct(IPersistLayer $persistLayer, object $entity)
    {
        $this->persistLayer = $persistLayer;
        $this->entity       = $entity;
    }


    /**
     * Remove entity object
     */
    public function execute(): void
    {
        $this->persistLayer->remove($this->entity);
    }
}
