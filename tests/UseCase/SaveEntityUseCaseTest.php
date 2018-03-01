<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 1/03/18
 * Time: 21:16
 */

namespace App\Tests\UseCase;

use App\Entity\IArtist;
use App\Service\FakeSpyPersistLayer;
use App\UseCase\SaveEntityUseCase;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

/**
 * Class SaveEntityUseCaseTest
 * @package App\Tests\UseCase
 */
class SaveEntityUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itCallSaveMethodOnce(): void
    {
        $persistLayer = new FakeSpyPersistLayer();
        $entity = m::mock(IArtist::class);

        (new SaveEntityUseCase($persistLayer))->execute($entity);

        $this->assertEquals(1, $persistLayer->getCountCallsSave());
    }
}
