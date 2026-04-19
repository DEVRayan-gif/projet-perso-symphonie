<?php

namespace App\Controller;

use App\Entity\Salle;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/salles')]
class SalleController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(SalleRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $salle = new Salle();
        $salle->setNom($data['nom']);
        $salle->setCapacite($data['capacite']);
        $salle->setAdresse($data['adresse']);
        $salle->setVille($data['ville']);

        $em->persist($salle);
        $em->flush();

        return $this->json($salle, 201);
    }
}