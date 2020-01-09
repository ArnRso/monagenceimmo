<?php


namespace App\Controller;


use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/profil", name="profil")
     * @param BienRepository $bienRepository
     * @return Response
     */
    public function profilShow(BienRepository $bienRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $biens = $bienRepository->findBy(["author" => $this->getUser()]);
        return $this->render("profil/profil.html.twig", [
            'biens' => $biens,
            'active' => 'profil'
        ]);
    }

    /**
     * @Route("/favoris", name="favoris")
     */
    public function favorisShow(BienRepository $bienRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        // TODO : Injecter les biens favoris !!!
        $tousLesbiens = $bienRepository->findBy(["author" => $this->getUser()]);
        $biens = [];

        foreach ($tousLesbiens as $bien) {
            if ($bien->isLikedByUser($this->getUser())) {
                array_push($biens, $bien);
            }
        }

        return $this->render("profil/profil.html.twig", [
            'biens' => $biens,
            'active' => 'favoris'
        ]);
    }
}