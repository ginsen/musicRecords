<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Artist
 * @package App\Entity
 */
class Artist implements IArtist
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
    private $name;


    /**
     * @var ArrayCollection
     * @Assert\Valid
     */
    private $albumArtists;


    /**
     * Artist constructor.
     * @param null|string $name
     */
    public function __construct(?string $name=null)
    {
        if ($name) {
            $this->name = $name;
        }

        $this->albumArtists = new ArrayCollection();
    }


    /**
     * @return null|string
     */
    public function __toString(): ?string
    {
        return $this->name;
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
    public function getName(): ?string
    {
        return $this->name;
    }


    /**
     * @inheritdoc
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
        $albumArtist->setArtist($this);
    }


    /**
     * @inheritdoc
     */
    public function removeAlbumArtist(IAlbumArtist $albumArtist): void
    {
        $this->albumArtists->removeElement($albumArtist);
    }
}
