<?php

namespace VeggieVibe\Vegetable\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use VeggieVibe\Vegetable\Application\Search\SearchVegetableById;
use VeggieVibe\Vegetable\Domain\VegetableId;
use VeggieVibe\Shared\Domain\UuidValidator;

#[Route(
    path: '/vegetables/{id}',
    name: 'veggievibe.api.vegetable.search',
    methods: ['GET']
)]
final class VegetableFinderController extends AbstractController
{
    public function __construct(
        private readonly SearchVegetableById $searchVegetableById,
        private readonly UuidValidator $uuidValidator,
    ) {
    }

    public function __invoke(string $id): Response
    {
        if (!$this->uuidValidator->isValid($id)) {
            return new JsonResponse(['error' => 'Invalid UUID'], 400);
        }
  
        $vegetableResponse = $this->searchVegetableById->__invoke(new VegetableId($id));
        if (!$vegetableResponse) {
            return new JsonResponse(['error' => 'Vegetable not found'], 404);
        }

        return new JsonResponse(
            [
                'id' => $vegetableResponse->id(),
                'name' => $vegetableResponse->name(),
                'quantity' => $vegetableResponse->quantity(),
                'unit' => $vegetableResponse->unit(),
            ],
            200
        );
    }
}