<?php
/**
 * Created by PhpStorm.
 * User: gin
 * Date: 1/03/18
 * Time: 17:44
 */

namespace App\Tests\UseCase;

use App\Repository\IAlbumRepository;
use App\Repository\IArtistRepository;
use App\UseCase\HomeUseCase;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class HomeUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function itCallFindAllRepositoriesAlbumAndArtist()
    {
        $albumRepo =  $this->getSpyAlbumRepo();
        $artistRepo = $this->getSpyArtistRepo();

        $useCase = new HomeUseCase($albumRepo, $artistRepo);
        $useCase->execute();

        $once = $albumRepo->verify();
        $this->assertTrue($once);
        //$this->assertTrue($artistRepo->shouldHaveReceived('findAll')->once());
    }


    /**
     * @return IAlbumRepository|\Mockery\VerificationDirector
     */
    protected function getSpyAlbumRepo(): IAlbumRepository
    {
        $albumRepo = m::spy(IAlbumRepository::class);
        $albumRepo->shouldHaveReceived('findAll')
                  ->once()
                  ->andReturn(null);

        return $albumRepo;
    }


    /**
     * @return IArtistRepository|\Mockery\VerificationDirector
     */
    protected function getSpyArtistRepo(): IArtistRepository
    {
        $albumRepo = m::mock(IArtistRepository::class);
        $albumRepo->shouldReceive('findAll')
                  ->once()
                  ->andReturn(null);

        return $albumRepo;
    }
}