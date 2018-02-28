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
 * Class SaveEntityUseCase
 * @package App\UseCase
 */
class SaveEntityUseCase
{
    /** @var IPersistLayer */
    protected $persistLayer;

    /** @var object */
    protected $entity;


    /**
     * SaveEntityUseCase constructor.
     *
     * @param IPersistLayer $persistLayer
     * @param object $entity
     */
    public function __construct(IPersistLayer $persistLayer, object $entity)
    {
        $this->persistLayer = $persistLayer;
        $this->entity       = $entity;
    }


    /**
     * Save entity object
     */
    public function execute(): void
    {
        $this->persistLayer->save($this->entity);
    }
}
