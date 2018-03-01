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
    public function itCallOnceFindAllInAlbumRepositoryAndArtistRepository(): void
    {
        $albumRepo =  m::spy(IAlbumRepository::class);
        $artistRepo = m::spy(IArtistRepository::class);

        (new HomeUseCase($albumRepo, $artistRepo))
            ->execute();

        try {
            $albumRepo->shouldHaveReceived('findAll')
                ->times(1);

            $albumRepo->shouldHaveReceived('findAll')
                ->times(1);

            $this->assertTrue(true);
        } catch (\Exception $exception) {
            $this->assertTrue(false, $exception->getMessage());
        }
    }
}
