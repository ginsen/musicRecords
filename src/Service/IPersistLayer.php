<?php
/**
 * Created by PhpStorm.
 * User: gin
 * Date: 28/02/18
 * Time: 15:37
 */

namespace App\Service;

/**
 * Interface IPersistLayer
 * @package App\Service
 */
interface IPersistLayer
{
    /**
     * Save entity.
     *
     * @param object $entity
     * @param bool|null $flush
     */
    public function save(object $entity, bool $flush=true): void;


    /**
     * Remove entity.
     *
     * @param object $entity
     * @param bool|null $flush
     */
    public function remove(object $entity, bool $flush=true): void;
}