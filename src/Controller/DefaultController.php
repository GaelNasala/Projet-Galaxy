<?php

namespace App\Controller;

use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // Récupérer les jeux depuis votre base de données (exemple)
        $jeux = $this->entityManager->getRepository(JeuxRepository::class)->findAll();

        return $this->render('home/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }
}
