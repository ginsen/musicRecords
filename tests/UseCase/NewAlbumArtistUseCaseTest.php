<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 1/03/18
 * Time: 20:51
 */

namespace App\Tests\UseCase;

use App\Entity\IAlbum;
use App\Entity\IAlbumArtist;
use App\Repository\IArtistRepository;
use App\Repository\IRoleRepository;
use App\UseCase\NewAlbumArtistUseCase;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

/**
 * Class NewAlbumArtistUseCaseTest
 * @package App\Tests\UseCase
 */
class NewAlbumArtistUseCaseTest extends TestCase
{
    /**
     * @test
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function itReturnNewAlbumArtist(): void
    {
        $artistRepo = m::spy(IArtistRepository::class);
        $roleRepo   = m::spy(IRoleRepository::class);
        $album      = m::mock(IAlbum::class);

        $albumArtist = (new NewAlbumArtistUseCase($artistRepo, $roleRepo))
            ->execute($album);

        $this->assertInstanceOf(IAlbumArtist::class, $albumArtist);

        try {
            $artistRepo->shouldHaveReceived('findOneArtist')
                ->times(1);

            $roleRepo->shouldHaveReceived('findOneRole')
                ->times(1);

            $this->assertTrue(true);
        } catch (\Exception $exception) {
            $this->assertTrue(false, $exception->getMessage());
        }

    }
}