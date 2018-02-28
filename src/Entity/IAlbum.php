<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 20:47
 */

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * Interface IAlbum
 * @package App\Entity
 */
interface IAlbum
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return null|string
     */
    public function getTitle(): ?string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

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
