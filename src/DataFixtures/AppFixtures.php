<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 28/02/18
 * Time: 19:04
 */

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\AlbumArtist;
use App\Entity\Artist;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    /** @var ObjectManager */
    protected $manager;


    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $roles   = $this->createRoles(['Voice', 'Flamenco Guitar', 'Hand-claps', 'Laud', 'Vihuela', 'Guitar']);
        $artists = $this->createArtists(['Juan', 'Antonio', 'Jose', 'Fernando', 'Pablo', 'Jordi']);
        $albums  = $this->createAlbums(['Concierto de Girona', 'Ratos de música']);

        $this->saveArtistOfAlbum($albums[0], [
            $roles[0], $roles[1], $roles[2]
        ], [
            $artists[0], $artists[1], $artists[2]
        ]);

        $this->saveArtistOfAlbum($albums[1], [
            $roles[3], $roles[4], $roles[5]
        ], [
            $artists[0], $artists[4], $artists[2]
        ]);

        $manager->flush();
    }


    /**
     * @param array $rolesName
     * @return array
     */
    private function createRoles(array $rolesName): array
    {
        $roles = [];
        foreach ($rolesName as $name) {
            $role = new Role($name);
            $this->manager->persist($role);
            $roles[] = $role;
        }

        return $roles;
    }


    /**
     * @param array $artistName
     * @return array
     */
    private function createArtists(array $artistName): array
    {
        $artists = [];
        foreach ($artistName as $name) {
            $artist = new Artist($name);
            $this->manager->persist($artist);
            $artists[] = $artist;
        }

        return $artists;
    }


    /**
     * @param array $albumsName
     * @return array
     */
    private function createAlbums(array $albumsName): array
    {
        $albums = [];
        foreach ($albumsName as $name) {
            $album = new Album($name);
            $this->manager->persist($album);
            $albums[] = $album;
        }

        return $albums;
    }


    /**
     * @param Album $album
     * @param array $roles
     * @param array $artists
     */
    private function saveArtistOfAlbum(Album $album, array $roles, array $artists): void
    {
        foreach ($artists as $artist) {
            $albumArtist = new AlbumArtist($artist, current($roles));
            $albumArtist->setTariff(1.2);
            $album->addAlbumArtist($albumArtist);
            next($roles);
        }

        $this->manager->persist($album);
    }
}
