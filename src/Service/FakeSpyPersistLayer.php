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
class FakeSpyPersistLayer implements IPersistLayer
{
    /** @var int */
    protected $countCallsSave = 0;

    /** @var int  */
    protected $countCallRemove = 0;


    /**
     * @inheritdoc
     */
    public function save($entity, bool $flush = true): void
    {
        $this->countCallsSave++;
        return;
    }


    /**
     * @inheritdoc
     */
    public function remove($entity, bool $flush = true): void
    {
        $this->countCallRemove++;
        return;
    }


    /**
     * @return int
     */
    public function getCountCallsSave(): int
    {
        return $this->countCallsSave;
    }


    /**
     * @return int
     */
    public function getCountCallRemove(): int
    {
        return $this->countCallRemove;
    }
}
