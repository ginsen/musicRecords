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
class NewAlbumArtist
{
    /** @var IArtistRepository */
    protected $artistRepo;

    /** @var IRoleRepository */
    protected $roleRepo;

    /** @var IAlbum */
    protected $album;


    /**
     * NewAlbumArtist constructor.
     *
     * @param IArtistRepository $artistRepo
     * @param IRoleRepository   $roleRepo
     * @param IAlbum            $album
     */
    public function __construct(IArtistRepository $artistRepo, IRoleRepository $roleRepo, IAlbum $album)
    {
        $this->artistRepo = $artistRepo;
        $this->roleRepo   = $roleRepo;
        $this->album      = $album;
    }


    /**
     * @return IAlbumArtist
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function execute(): IAlbumArtist
    {
        $artist = $this->artistRepo->findOneArtist();
        $role   = $this->roleRepo->findOneRole();

        return new AlbumArtist($artist, $role, $this->album);
    }
}