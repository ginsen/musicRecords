<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 1/03/18
 * Time: 21:09
 */

namespace App\Tests\UseCase;

use App\Entity\IAlbum;
use App\Service\FakeSpyPersistLayer;
use App\UseCase\RemoveEntityUseCase;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

/**
 * Class RemoveEntityUseCaseTest
 * @package App\Tests\UseCase
 */
class RemoveEntityUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itCallRemoveMethodOnce(): void
    {
        $persistLayer = new FakeSpyPersistLayer();
        $entity = m::mock(IAlbum::class);

        (new RemoveEntityUseCase($persistLayer))->execute($entity);

        $this->assertEquals(1, $persistLayer->getCountCallRemove());
    }
}
