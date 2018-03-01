<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:43
 */

namespace App\Controller;

use App\Entity\Album;
use App\Entity\AlbumArtist;
use App\Form\AlbumArtistType;
use App\UseCase\ChangePositionListUseCase;
use App\UseCase\NewAlbumArtistUseCase;
use App\UseCase\RemoveEntityUseCase;
use App\UseCase\SaveEntityUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlbumArtistController
 * @package App\Controller
 */
class AlbumArtistController extends Controller
{
    /**
     * @Route("/album-artist/position/{act}/{id}", name="album_artist_position", requirements={
     *     "act" = "up|down|top|bottom",
     *     "id" = "\d+"
     * })
     * @ParamConverter("albumArtist", class="App:AlbumArtist", options={ "repository_method" = "findAlbumArtist" })
     * @param AlbumArtist $albumArtist
     * @param Request $request
     * @return Response
     */
    public function setPosition(AlbumArtist $albumArtist, Request $request) :Response
    {
        $persistLayer = $this->get('app.doctrine.persist.layer');
        $action       = $request->get('act');

        $albumArtist = (new ChangePositionListUseCase($persistLayer))
            ->execute($albumArtist, $action);

        return $this->redirectToRoute('album_show', [
            'id' => $albumArtist->getAlbum()->getId()
        ]);
    }


    /**
     * @Route("/album-artist/edit/{id}", name="album_artist_edit", requirements={ "id" = "\d+" })
     * @ParamConverter("albumArtist", class="App:AlbumArtist", options={ "repository_method" = "findAlbumArtist" })
     * @param AlbumArtist $albumArtist
     * @param Request $request
     * @return Response
     */
    public function editAlbumArtist(AlbumArtist $albumArtist, Request $request): Response
    {
        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer))
                ->execute($albumArtist);

            return $this->redirectToRoute('album_show', [
                'id' => $albumArtist->getAlbum()->getId()
            ]);
        }

        return $this->render('albumArtist/edit_album_artist.html.twig', [
            'album' => $albumArtist->getAlbum(),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album-artist/new/{id}", name="album_artist_new", requirements={ "id" = "\d+" })
     * @ParamConverter("album", options={"repository_method" = "findAlbum"})
     * @param Album $album
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function newAlbumArtist(Album $album, Request $request)
    {
        $artistRepo = $this->get('App\Repository\ArtistRepository');
        $roleRepo   = $this->get('App\Repository\RoleRepository');

        $albumArtist = (new NewAlbumArtistUseCase($artistRepo, $roleRepo))->execute($album);

        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer))
                ->execute($albumArtist);

            return $this->redirectToRoute('album_show', [
                'id' => $albumArtist->getAlbum()->getId()
            ]);
        }

        return $this->render('albumArtist/edit_album_artist.html.twig', [
            'album' => $albumArtist->getAlbum(),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album-artist/remove/{id}", name="album_artist_remove", requirements={
     *     "id" = "\d+"
     * })
     * @param AlbumArtist $albumArtist
     * @return Response
     */
    public function removeAlbumArtist(AlbumArtist $albumArtist): Response
    {
        $albumId = $albumArtist->getAlbum()->getId();

        $persistLayer = $this->get('app.doctrine.persist.layer');
        (new RemoveEntityUseCase($persistLayer))
            ->execute($albumArtist);

        return $this->redirectToRoute('album_show', [
            'id' => $albumId
        ]);
    }
}
