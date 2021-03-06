<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 18:43
 */

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\UseCase\HomeUseCase;
use App\UseCase\RemoveEntityUseCase;
use App\UseCase\SaveEntityUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlbumController
 * @package App\Controller
 */
class AlbumController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function home(): Response
    {
        $albumRepo  = $this->get('App\Repository\AlbumRepository');
        $artistRepo = $this->get('App\Repository\ArtistRepository');

        [$albums, $artists] = (new HomeUseCase($albumRepo, $artistRepo))->execute();

        return $this->render('album/index.html.twig', [
            'albums' => $albums,
            'artists' => $artists,
        ]);
    }


    /**
     * @Route("/album/{id}", name="album_show", requirements={ "id" = "\d+" })
     * @ParamConverter("album", class="App:Album", options={ "repository_method" = "findAlbum" })
     * @param Album $album
     * @return Response
     */
    public function showAlbum(Album $album): Response
    {
        return $this->render('album/show_album.html.twig', [
            'album' => $album
        ]);
    }


    /**
     * @Route("/album/new", name="album_new")
     * @param Request $request
     * @return Response
     */
    public function newAlbum(Request $request): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $album = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer))
                ->execute($album);

            return $this->redirectToRoute('album_show', [
                'id' => $album->getId()
            ]);
        }

        return $this->render('album/edit_album.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/album/remove/{id}", name="album_remove", requirements={ "id" = "\d+" })
     * @param Album $album
     * @return Response
     */
    public function removeAlbum(Album $album): Response
    {
        $persistLayer = $this->get('app.doctrine.persist.layer');
        (new RemoveEntityUseCase($persistLayer))
            ->execute($album);

        return $this->redirectToRoute('homepage');
    }
}
