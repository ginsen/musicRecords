<?php
/**
 * Created by PhpStorm.
 * User: gin
 * Date: 1/03/18
 * Time: 17:15
 */

namespace App\Tests\UseCase;

use App\Entity\AlbumArtist;
use App\Entity\IAlbumArtist;
use App\Service\FakeSpyPersistLayer;
use App\UseCase\ChangePositionListUseCase;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangePositionListUseCaseTest
 * @package App\Tests\UseCase
 */
class ChangePositionListUseCaseTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataProviderPositions
     *
     * @param string $action
     * @param int    $oldPosition
     * @param int    $newPosition
     * @param bool   $persisted
     */
    public function itChangeAlbumArtistPosition(
        string $action,
        int $oldPosition,
        int $newPosition,
        bool $persisted
    ): void
    {
        $persistLayer = new FakeSpyPersistLayer();
        $albumArtist = $this->getAlbumArtist($oldPosition);

        (new ChangePositionListUseCase($persistLayer))->execute($albumArtist, $action);

        $this->assertEquals($newPosition, $albumArtist->getPosition());
        $this->assertEquals($persisted, (bool)$persistLayer->getCountCallsSave());
    }


    /**
     * @return array
     */
    public function dataProviderPositions(): array
    {
        return [
            ['up', 3, 2, true],
            ['up', 0, 0, false],
            ['down', 0, 1, true],
            ['top', 3, 0, true],
            ['bottom', 2, -1, true]
        ];
    }


    /**
     * @param int $position
     * @return IAlbumArtist
     */
    protected function getAlbumArtist(int $position): IAlbumArtist
    {
        $albumArtist = new AlbumArtist();
        $albumArtist->setPosition($position);

        return $albumArtist;
    }
}