<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bien")
 */
class BienController extends AbstractController
{
    /**
     * @Route("/", name="bien_index", methods={"GET"})
     */
    public function index(BienRepository $bienRepository): Response
    {
        return $this->render('bien/index.html.twig', [
            'biens' => $bienRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bien_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->redirectToRoute('bien_index');
        }

        return $this->render('bien/new.html.twig', [
            'bien' => $bien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bien_show", methods={"GET"})
     */
    public function show(Bien $bien): Response
    {
        //Envoie l'addresse au géocodeur Google Map pour récupérer la latitude et la longitude de l'appartement
//        $adresse = "";
//        $adresse .= $bien->getNumeroRue() . " ";
//        $adresse .= $bien->getRue() . " ";
//        if ($bien->getRueComplement()) {
//            $adresse .= $bien->getRueComplement() . " ";
//        }
//        $adresse .= $bien->getVille();
//        $adresse = str_replace(' ', '+', $adresse);
//        $mapApiKey = "AIzaSyA6jy16mTR7Gb9ctCCYelY35TZ__gTHsTA";
//        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $adresse . "&key=" . $mapApiKey;
//        $mapgetcontent = file_get_contents($url);
//        $mapgetcontent = json_decode($mapgetcontent);
//        $lat = $mapgetcontent->results[0]->geometry->location->lat;
//        $lng = $mapgetcontent->results[0]->geometry->location->lng;

        return $this->render('bien/show.html.twig', [
            'bien' => $bien,
//            'lat'=>$lat,
//            'lng'=>$lng
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bien_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bien $bien): Response
    {
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bien_index');
        }

        return $this->render('bien/edit.html.twig', [
            'bien' => $bien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bien_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bien $bien): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bien->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bien_index');
    }
}
