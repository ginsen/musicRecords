<?php
/**
 * Created by PhpStorm.
 * User: ginsen
 * Date: 27/02/18
 * Time: 23:35
 */

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\UseCase\SaveEntityUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArtistController
 * @package App\Controller
 */
class ArtistController extends Controller
{
    /**
     * @Route("/artist/{id}", name="artist_show", requirements={ "id" = "\d+" })
     * @ParamConverter("artist", options={ "repository_method" = "findArtist" })
     * @param Artist $artist
     * @return Response
     */
    public function showArtist(Artist $artist): Response
    {
        return $this->render('artist/show_artist.html.twig', [
            'artist' => $artist,
        ]);
    }


    /**
     * @Route("/artist/new", name="artist_new")
     * @param Request $request
     * @return Response
     */
    public function createArtist(Request $request): Response
    {
        $form = $this->createForm(ArtistType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $artist = $form->getData();

            $persistLayer = $this->get('app.doctrine.persist.layer');
            (new SaveEntityUseCase($persistLayer))
                ->execute($artist);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('artist/new_artist.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
