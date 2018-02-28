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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
        [$albums, $artists] = $this->get('app.home.use-case')->execute();

        return $this->render('album/index.html.twig', [
            'albums' => $albums,
            'artists' => $artists,
        ]);
    }


    /**
     * @Route("/album/{id}", name="show_album", requirements={
     *     "id" = "\d+"
     * })
     * @Method("GET")
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
     * @Route("/album/new", name="new_album")
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
            $this->get('app.persist-entity.use-case')->execute($album);

            return $this->redirectToRoute('show_album', [
                'id' => $album->getId()
            ]);
        }

        return $this->render('album/edit_album.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
