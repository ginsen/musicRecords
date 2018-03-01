<?php
/**
 * Created by PhpStorm.
 * User: gin
 * Date: 1/03/18
 * Time: 17:26
 */

namespace App\Service;

/**
 * Class FakePersistLayer to Unit Tests
 * @package App\Service
 */
class FakePersistLayer implements IPersistLayer
{
    /**
     * @inheritdoc
     */
    public function save($entity, bool $flush = true): void {
        return;
    }

    /**
     * @inheritdoc
     */
    public function remove($entity, bool $flush = true): void {
        return;
    }
}