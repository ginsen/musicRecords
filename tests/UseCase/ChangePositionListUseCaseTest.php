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
use App\Service\FakePersistLayer;
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
     * @param string $action
     * @param int $oldPosition
     * @param int $newPosition
     */
    public function itChangeAlbumArtistPosition(string $action, int $oldPosition, int $newPosition): void
    {
        $persistLayer = new FakePersistLayer();
        $albumArtist = $this->getAlbumArtist($oldPosition);

        (new ChangePositionListUseCase($persistLayer))->execute($albumArtist, $action);

        $this->assertEquals($newPosition, $albumArtist->getPosition());
    }


    /**
     * @return array
     */
    public function dataProviderPositions(): array
    {
        return [
            ['up', 3, 2],
            ['up', 0, 0],
            ['down', 0, 1],
            ['top', 3, 0],
            ['bottom', 2, -1]
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