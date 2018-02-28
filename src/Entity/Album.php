<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Album
 * @package App\Entity
 */
class Album implements IAlbum
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max=120, min=3)
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var ArrayCollection
     * @Assert\Valid
     */
    private $albumArtists;


    /**
     * Album constructor.
     * @param null|string $title
     */
    public function __construct(?string $title=null)
    {
        if ($title) {
            $this->title = $title;
        }

        $this->albumArtists = new ArrayCollection();
        $this->createdAt    = new \DateTime();
    }


    /**
     * @return null|string
     */
    public function __toString()
    {
        return $this->title;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * @inheritdoc
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @inheritdoc
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }


    /**
     * @inheritdoc
     */
    public function getAlbumArtists(): Collection
    {
        return $this->albumArtists;
    }


    /**
     * @inheritdoc
     */
    public function addAlbumArtist(IAlbumArtist $albumArtist): void
    {
        $this->albumArtists[] = $albumArtist;
        $albumArtist->setAlbum($this);
    }


    /**
     * @inheritdoc
     */
    public function removeAlbumArtist(IAlbumArtist $albumArtist): void
    {
        $this->albumArtists->removeElement($albumArtist);
    }
}
