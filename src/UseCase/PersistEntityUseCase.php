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
 * Class PersistEntityUseCase
 * @package App\UseCase
 */
class PersistEntityUseCase
{
    /** @var IPersistLayer */
    protected $persistLayer;

    /** @var object */
    protected $entity;


    /**
     * PersistEntityUseCase constructor.
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
     * Persist entity object
     */
    public function execute(): void
    {
        $this->persistLayer->save($this->entity);
    }
}
