<?php

namespace App\Controller\Api;

use App\Repository\DestinationRepository;
use App\Utils\JsonResponseFormatterInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;

#[Route('/api')]
class DestinationController extends AbstractController
{
    #[Route('/destinations', methods: ["GET"])]
    #[OA\Get(
        operationId: 'get_all_destinations',
        summary: 'Get all destinations',
        tags: ['Destination'],
        parameters: [
            new OA\Parameter(
                name: "offset",
                description: "Offset",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "integer", default: 0, minimum: 0)
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Success",
                content: new OA\JsonContent(
                    type: "object",
                    example: [
                        "message" => "Liste des destinations",
                        "data" => [
                            [
                                "id" => 1,
                                "name" => "Bin El Ouidiane",
                                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ll.",
                                "price" => 1100,
                                "duration" => 3,
                                "image" => "https://www.shutterstock.com/image-photo/bin-el-quidane-morocco-april-600nw-2417328387.jpg"
                            ],
                            [
                                "id" => 3,
                                "name" => "Merzouga",
                                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "price" => 1400,
                                "duration" => 3,
                                "image" => "https://www.frs.es/fileadmin/_processed_/9/e/csm_csm_frs-iberia-destinos-erfoud-dos_d995027a85.jpg"
                            ]
                        ]
                    ]
                )
            ),
            new OA\Response(
                response: Response::HTTP_BAD_REQUEST,
                description: "Error",
                content: new OA\JsonContent(
                    type: "object",
                    example: [
                        "message" => "Le paramètre envoyé ne correspond pas",
                        "data" => []
                    ]
                )
            ),
        ]
    )]
    public function index(
        DestinationRepository $destinationRepository,
        SerializerInterface $serializer,
        Request $request,
        JsonResponseFormatterInterface $jsonResponseFormatter
    ): Response
    {
        try {
            $offset = $request->query->get('offset', 0);
            $destinations = $destinationRepository->findBy([], [], 20, $offset);
            $output = [];
            foreach ($destinations as $i => $destination) {
                $output[] = json_decode($serializer->serialize($destination, 'json'));
            }

            return new JsonResponse(
                $jsonResponseFormatter->formatResponse("Liste des destinations", $output),
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            return new JsonResponse(
                $jsonResponseFormatter->formatResponse("API response error" . $exception->getMessage()),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
