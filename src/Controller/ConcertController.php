<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Repository\ConcertRepository;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/concerts')]
class ConcertController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(ConcertRepository $repo): JsonResponse
    {
        $concerts = $repo->findAll();
        $data = [];
        foreach ($concerts as $concert) {
            $data[] = [
                'id' => $concert->getId(),
                'titre' => $concert->getTitre(),
                'date' => $concert->getDate()->format('Y-m-d H:i:s'),
                'prix' => $concert->getPrix(),
                'nbPlaces' => $concert->getNbPlaces(),
                'salle' => $concert->getSalle() ? $concert->getSalle()->getNom() : null
            ];
        }
        return $this->json($data);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(Concert $concert): JsonResponse
    {
        return $this->json([
            'id' => $concert->getId(),
            'titre' => $concert->getTitre(),
            'date' => $concert->getDate()->format('Y-m-d H:i:s'),
            'prix' => $concert->getPrix(),
            'nbPlaces' => $concert->getNbPlaces(),
            'salle' => $concert->getSalle() ? $concert->getSalle()->getNom() : null
        ]);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, SalleRepository $salleRepo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $concert = new Concert();
        $concert->setTitre($data['titre']);
        $concert->setDate(new \DateTime($data['date']));
        $concert->setPrix($data['prix']);
        $concert->setNbPlaces($data['nbPlaces']);

        $salle = $salleRepo->find($data['salleId']);
        $concert->setSalle($salle);

        $em->persist($concert);
        $em->flush();

        return $this->json([
            'id' => $concert->getId(),
            'titre' => $concert->getTitre(),
            'prix' => $concert->getPrix(),
            'nbPlaces' => $concert->getNbPlaces(),
            'salle' => $concert->getSalle()->getNom()
        ], 201);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Concert $concert, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($concert);
        $em->flush();

        return $this->json(['message' => 'Concert supprimé'], 200);
    }
}