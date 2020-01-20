<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\User;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
 * @param BienRepository $bienRepository
 * @return Response
 */
public function index(BienRepository $bienRepository): Response
{
    return $this->render('bien/index.html.twig', [
        'biens' => $bienRepository->findAll(),
    ]);
}

/**
 * @Route("/recherche", name="bien_recherche_simple")
 * @param Request $request
 * @param BienRepository $bienRepository
 * @return Response
 */
public function simpleSearch(Request $request, BienRepository $bienRepository): Response
{
    $localisation = $request->query->get('localisation');
    if (strlen($localisation) == 0) {
        $localisation = "";
    }
    $prixMax = $request->query->get('prixMax');
    if (strlen($prixMax) == 0) {
        $prixMax = "";
    }
    $bonus = $request->query->get('bonus');
    $surfaceMin = $request->query->get('surfaceMin');
    $biens = $bienRepository->simpleSearch($localisation, $prixMax, $surfaceMin, $bonus);
    return $this->render('bien/index.html.twig', [
        'biens' => $biens
    ]);
}

    /**
     * @Route("/new", name="bien_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
public function new(Request $request): Response
{
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $bien = new Bien();
    $form = $this->createForm(BienType::class, $bien);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // stock toutes les images envoyées par le formulaire dans $images
        $images = $request->files->get('bien')['images'];
        // boucle sur chacune des images
        if ($images != null) {
            // boucle sur chacune des images
            foreach ($images as $image) {
                // stock le dossier de destination défini dans config/services.yaml
                $upload_directory = $this->getParameter('uploads_directory');
                // génère un nom unique pour chauque photo
                $filename = md5(uniqid()) . '.' . $image->guessExtension();
                // déplace le fichier dans le dossier désiré
                $image->move(
                    // dossier de destination
                    $upload_directory,
                    // nom du fichier
                    $filename
                );
                // Ajoute le nom du fichier image à l'array Images dans la BDD
                $bien->addImages($filename);
            }
        }
        $bien->setAuthor($this->getUser());
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
 *
 * Affiche un seul bien, celui dont l'ID est précisé dans la WildCard
 */
public function show(Bien $bien): Response
{
    return $this->render('bien/show.html.twig', [
        'bien' => $bien
    ]);
}

    /**
     * @Route("/{id}/edit", name="bien_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Bien $bien
     * @return Response
     */
public function edit(Request $request, Bien $bien): Response
{
    if ($bien->getAuthor() == $this->getUser()) {
            $form = $this->createForm(BienType::class, $bien);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // stock toutes les images envoyées par le formulaire dans $images
                $images = $request->files->get('bien')['images'];
                if ($images != null) {
                    // boucle sur chacune des images
                    foreach ($images as $image) {
                        // stock le dossier de destination défini dans config/services.yaml
                        $upload_directory = $this->getParameter('uploads_directory');
                        // génère un nom unique pour chauque photo
                        $filename = md5(uniqid()) . '.' . $image->guessExtension();
                        // déplace le fichier dans le dossier désiré
                        $image->move(
                            // dossier de destination
                            $upload_directory,
                            // nom du fichier
                            $filename
                        );
                        // Ajoute le nom du fichier image à l'array Images dans la BDD
                        $bien->addImages($filename);
                    }
                }

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('bien_index');
            }

            return $this->render('bien/edit.html.twig', [
                'bien' => $bien,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/delete", name="bien_delete")
     * @param Request $request
     * @param Bien $bien
     * @return Response
     */
    public function delete(Request $request, Bien $bien): Response
    {
        if ($this->getUser() == $bien->getAuthor()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bien);
            $entityManager->flush();
        }


        return $this->redirectToRoute('profil');
    }

    /**
     * Permet de supprimer une image en particulier d'un article donné
     * @Route("/{id}/img/delete/{id_image}", name="bien_image_delete")
     * @param $id
     * @param $id_image
     * @param EntityManagerInterface $entityManager
     * @param BienRepository $bienRepository
     * @return RedirectResponse
     */
    public function deleteImage($id, $id_image, EntityManagerInterface $entityManager, BienRepository $bienRepository)
    {
        $bien = $bienRepository->find($id);
        $images = $bien->getImages();
        array_splice($images, $id_image, 1);
        $bien->setImages($images);
        $entityManager->persist($bien);
        $entityManager->flush();
        return $this->redirectToRoute('bien_edit', ['id' => $id]);
    }

    /**
     * Permet d'ajouter ou de retirer des favoris un bien
     * @Route("/{id}/favoris", name="bien_favoris")
     * @param Bien $bien
     * @param EntityManagerInterface $entityManager
     * @param BienRepository $bienRepository
     * @return Response
     */
    public function favoris(Bien $bien, EntityManagerInterface $entityManager, BienRepository $bienRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json([
                'code' => 403,
                'message' => "Unauthorized"
            ], 403);
        }

        if ($bien->isLikedByUser($user)) {
            $bien->removeLikedBy($user);
            $entityManager->persist($bien);
            $entityManager->flush();

            return $this->json(
                [
                    'code' => 200,
                    'message' => 'Retiré des favoris avec succès',
                    'favoris' => count($bien->getLikedBy())
                ],
                200
            );
        }

        $bien->addLikedBy($user);
        $entityManager->persist($bien);
        $entityManager->flush();
        return $this->json(
            [
                'code' => 200,
                'message' => 'Ajouté aux favoris avec succès',
                'favoris' => count($bien->getLikedBy())
            ],
            200
        );
    }
}
