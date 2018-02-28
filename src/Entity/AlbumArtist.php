<?php

namespace App\Entity;

/**
 * Class AlbumArtist
 * @package App\Entity
 */
class AlbumArtist implements IAlbumArtist
{
    /**
     * @var int
     */
    private $id;


    /**
     * @var IAlbum
     */
    private $album;


    /**
     * @var IArtist
     */
    private $artist;


    /**
     * @var IRole
     */
    private $role;

    /**
     * @var float
     */
    private $tariff;


    /**
     * @var int
     */
    private $position;


    /**
     * AlbumArtist constructor.
     * @param IArtist|null $artist
     * @param IRole|null $role
     * @param IAlbum|null $album
     */
    public function __construct(?IArtist $artist=null, ?IRole $role=null, ?IAlbum $album=null)
    {
        if ($artist) {
            $this->artist = $artist;
        }

        if ($role) {
            $this->role = $role;
        }

        if ($album) {
            $this->album = $album;
        }

        $this->tariff = 0;
    }


    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @inheritdoc
     */
    public function getAlbum(): IAlbum
    {
        return $this->album;
    }


    /**
     * @inheritdoc
     */
    public function setAlbum(IAlbum $album): void
    {
        $this->album = $album;
    }


    /**
     * @inheritdoc
     */
    public function getArtist(): IArtist
    {
        return $this->artist;
    }


    /**
     * @inheritdoc
     */
    public function setArtist(IArtist $artist): void
    {
        $this->artist = $artist;
    }


    /**
     * @inheritdoc
     */
    public function getRole(): IRole
    {
        return $this->role;
    }


    /**
     * @inheritdoc
     */
    public function setRole(IRole $role): void
    {
        $this->role = $role;
    }


    /**
     * @inheritdoc
     */
    public function getTariff(): float
    {
        return $this->tariff;
    }


    /**
     * @inheritdoc
     */
    public function setTariff(float $tariff): void
    {
        $this->tariff = $tariff;
    }


    /**
     * @inheritdoc
     */
    public function getPosition(): int
    {
        return $this->position;
    }


    /**
     * @inheritdoc
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
