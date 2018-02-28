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
use App\UseCase\PersistEntityUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Method("GET")
     * @param AlbumArtist $albumArtist
     * @param Request $request
     * @return Response
     */
    public function setPosition(AlbumArtist $albumArtist, Request $request) :Response
    {
        $persistLayer = $this->get('app.doctrine.persist.layer');
        $action       = $request->get('act');

        $albumArtist = (new ChangePositionListUseCase($albumArtist, $persistLayer, $action))
            ->execute();

        return $this->redirectToRoute('show_album', [
            'id' => $albumArtist->getAlbum()->getId()
        ]);
    }


    /**
     * @Route("/album-artist/edit/{id}", name="edit_album_artist", requirements={
     *     "id" = "\d+"
     * })
     * @Method("GET")
     * @param AlbumArtist $albumArtist
     * @param Request $request
     * @return Response
     */
    public function edit(AlbumArtist $albumArtist, Request $request): Response
    {
        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new PersistEntityUseCase($persistLayer, $albumArtist))
                ->execute();

            return $this->redirectToRoute('show_album', [
                'id' => $albumArtist->getAlbum()->getId()
            ]);
        }

        return $this->render('albumArtist/edit_album_artist.html.twig', [
            'album' => $albumArtist->getAlbum(),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album-artist/new/{album_id}", name="new_album_artist", requirements={
     *     "album_id" = "\d+"
     * })
     * @param Request $request
     * @return Response
     */
    public function newAlbumArtist(Album $album, Request $request)
    {
        $role   = $albumManager->getOneRole();
        $artist = $albumManager->getOneArtist();

        $albumArtist = new AlbumArtist($artist, $role, $album);

        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();
            $albumManager->saveEntity($albumArtist);

            return $this->redirectToRoute('show_album', [
                'id' => $albumArtist->getAlbum()->getId()
            ]);
        }

        return $this->render('albumArtist/edit_album_artist.html.twig', [
            'album' => $albumArtist->getAlbum(),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album-artist/remove/{id}", name="remove_album_artist", requirements={
     *     "id" = "\d+"
     * })
     * @param Request $request
     * @return Response
     */
    public function removeAlbumArtist(Request $request): Response
    {
        $albumArtistId = $request->get('id');

        $albumManager = $this->get('app.manager.album');
        $albumArtist = $albumManager->getAlbumArtist($albumArtistId);
        $albumId = $albumArtist->getAlbum()->getId();

        $albumManager->removeEntity($albumArtist);

        return $this->redirectToRoute('show_album', [
            'id' => $albumId
        ]);
    }
}
