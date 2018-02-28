<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:43
 */

namespace App\Controller;

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
     * @param Request $request
     * @return Response
     */
    public function setPosition(Request $request) :Response
    {
        $albumArtistId = $request->get('id');
        $action        = $request->get('act');

        $albumManager = $this->get('app.manager.album');
        $albumArtist = $albumManager->getAlbumArtist($albumArtistId);
        $position = $albumArtist->getPosition();

        $newPosition = $albumManager->getNewPosition($action, $position);

        if ($newPosition !== $position) {
            $albumArtist->setPosition($newPosition);
            $albumManager->saveEntity($albumArtist);
        }

        return $this->redirectToRoute('show_album', [
            'id' => $albumArtist->getAlbum()->getId()
        ]);
    }


    /**
     * @Route("/album-artist/edit/{id}", name="edit_album_artist", requirements={
     *     "id" = "\d+"
     * })
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request): Response
    {
        $albumArtistId = $request->get('id');

        $albumManager = $this->get('app.manager.album');
        $albumArtist = $albumManager->getAlbumArtist($albumArtistId);

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
     * @Route("/album-artist/new/{album_id}", name="new_album_artist", requirements={
     *     "album_id" = "\d+"
     * })
     * @param Request $request
     * @return Response
     */
    public function newAlbumArtist(Request $request)
    {
        $albumId = $request->get('album_id');

        $albumManager = $this->get('app.manager.album');
        $album  = $albumManager->getAlbum($albumId);
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
