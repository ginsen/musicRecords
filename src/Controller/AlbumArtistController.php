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
use App\UseCase\NewAlbumArtist;
use App\UseCase\RemoveEntityUseCase;
use App\UseCase\SaveEntityUseCase;
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
    public function editAlbumArtist(AlbumArtist $albumArtist, Request $request): Response
    {
        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer, $albumArtist))
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
     * @Method("GET")
     * @param Album $album
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function newAlbumArtist(Album $album, Request $request)
    {
        $artistRepo = $this->get('App\Repository\ArtistRepository');
        $roleRepo   = $this->get('App\Repository\RoleRepository');

        $albumArtist = (new NewAlbumArtist($artistRepo, $roleRepo, $album))->execute();

        $form = $this->createForm(AlbumArtistType::class, $albumArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $albumArtist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer, $albumArtist))
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
     * @Route("/album-artist/remove/{id}", name="remove_album_artist", requirements={
     *     "id" = "\d+"
     * })
     * @Method("GET")
     * @param AlbumArtist $albumArtist
     * @return Response
     */
    public function removeAlbumArtist(AlbumArtist $albumArtist): Response
    {
        $albumId = $albumArtist->getAlbum()->getId();

        $persistLayer = $this->get('app.doctrine.persist.layer');
        (new RemoveEntityUseCase($persistLayer, $albumArtist))
            ->execute();

        return $this->redirectToRoute('show_album', [
            'id' => $albumId
        ]);
    }
}
