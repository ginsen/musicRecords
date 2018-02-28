<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 20:50
 */

namespace App\Entity;

/**
 * Interface IAlbumArtist
 * @package App\Entity
 */
interface IAlbumArtist
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return IAlbum
     */
    public function getAlbum(): IAlbum;

    /**
     * @param IAlbum $album
     */
    public function setAlbum(IAlbum $album): void;

    /**
     * @return IArtist
     */
    public function getArtist(): IArtist;

    /**
     * @param IArtist $artist
     */
    public function setArtist(IArtist $artist): void;

    /**
     * @return IRole
     */
    public function getRole(): IRole;

    /**
     * @param IRole $role
     */
    public function setRole(IRole $role): void;

    /**
     * @return float
     */
    public function getTariff(): float;


    /**
     * @param float $tariff
     */
    public function setTariff(float $tariff): void;


    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     */
    public function setPosition(int $position): void;
}