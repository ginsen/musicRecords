<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:49
 */

namespace App\UseCase;
use App\Entity\IAlbum;
use App\Repository\IAlbumArtistRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ChangePositionListUseCase
 * @package App\UseCase
 */
class ChangePositionListUseCase
{
    /** @var IAlbumArtistRepository */
    protected $albumArtistRepo;

    /** @var EntityManagerInterface */
    protected $em;


    /**
     * ChangePositionListUseCase constructor.
     * @param IAlbumArtistRepository $albumArtistRepo
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        IAlbumArtistRepository $albumArtistRepo,
        EntityManagerInterface $entityManager
    ) {
        $this->albumArtistRepo = $albumArtistRepo;
        $this->em = $entityManager;

    }


    /**
     * @return IAlbum
     */
    public function execute(): IAlbum
    {
        $this->albumArtistRepo->findAlbumArtist($album_artist_id);
    }
}