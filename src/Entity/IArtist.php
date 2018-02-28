<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 21:03
 */

namespace App\Entity;
use Doctrine\Common\Collections\Collection;

/**
 * Interface IArtist
 * @package App\Entity
 */
interface IArtist
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return Collection
     */
    public function getAlbumArtists(): Collection;

    /**
     * @param IAlbumArtist $albumArtist
     */
    public function addAlbumArtist(IAlbumArtist $albumArtist): void;

    /**
     * @param IAlbumArtist $albumArtist
     */
    public function removeAlbumArtist(IAlbumArtist $albumArtist): void;
}
