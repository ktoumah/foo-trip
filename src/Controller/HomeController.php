<?php

namespace App\Controller;

use App\Entity\Destination;
use App\Repository\DestinationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        DestinationRepository $destinationRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $destinations = $paginator->paginate(
            $destinationRepository->findAllQuery(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('home/index.html.twig', [
            'destinations' => $destinations,
        ]);
    }
    #[Route('/view/{id}', name: 'app_view', requirements: ['id' => '\d+'])]
    public function view(
        Destination $destination
    ): Response
    {
        return $this->render('home/view.html.twig', [
            'destination' => $destination,
        ]);
    }
}
