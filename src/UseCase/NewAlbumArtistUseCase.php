<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 28/02/18
 * Time: 17:34
 */

namespace App\UseCase;

use App\Entity\AlbumArtist;
use App\Entity\IAlbum;
use App\Entity\IAlbumArtist;
use App\Repository\IArtistRepository;
use App\Repository\IRoleRepository;

/**
 * Class NewAlbumArtist
 * @package App\UseCase
 */
class NewAlbumArtistUseCase
{
    /** @var IArtistRepository */
    protected $artistRepo;

    /** @var IRoleRepository */
    protected $roleRepo;


    /**
     * NewAlbumArtist constructor.
     *
     * @param IArtistRepository $artistRepo
     * @param IRoleRepository   $roleRepo
     */
    public function __construct(IArtistRepository $artistRepo, IRoleRepository $roleRepo)
    {
        $this->artistRepo = $artistRepo;
        $this->roleRepo   = $roleRepo;
    }


    /**
     * @param IAlbum $album
     * @return IAlbumArtist
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function execute(IAlbum $album): IAlbumArtist
    {
        $artist = $this->artistRepo->findOneArtist();
        $role   = $this->roleRepo->findOneRole();

        return new AlbumArtist($artist, $role, $album);
    }
}