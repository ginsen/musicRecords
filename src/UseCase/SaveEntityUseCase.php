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


    /**
     * SaveEntityUseCase constructor.
     *
     * @param IPersistLayer $persistLayer
     */
    public function __construct(IPersistLayer $persistLayer)
    {
        $this->persistLayer = $persistLayer;
    }


    /**
     * Persist entity.
     *
     * @param object $entity
     */
    public function execute($entity): void
    {
        $this->persistLayer->save($entity);
    }
}
