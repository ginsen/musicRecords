<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 21:55
 */

namespace App\UseCase;


use App\Repository\IAlbumRepository;
use App\Repository\IArtistRepository;

class HomeUseCase
{
    /** @var IAlbumRepository */
    protected $albumRepo;

    /** @var IArtistRepository */
    protected $artistRepo;


    /**
     * HomeUseCase constructor.
     * @param IAlbumRepository  $albumRepo
     * @param IArtistRepository $artistRepo
     */
    public function __construct(IAlbumRepository $albumRepo, IArtistRepository $artistRepo)
    {
        $this->albumRepo = $albumRepo;
        $this->artistRepo = $artistRepo;
    }


    /**
     * @return array
     */
    public function execute(): array
    {
        return [
            $this->albumRepo->findAll(),
            $this->artistRepo->findAll(),
        ];
    }
}
