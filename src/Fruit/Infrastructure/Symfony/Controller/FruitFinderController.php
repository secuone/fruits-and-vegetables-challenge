<?php

namespace VeggieVibe\Fruit\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use VeggieVibe\Fruit\Application\Search\SearchFruitById;
use VeggieVibe\Fruit\Domain\FruitId;
use VeggieVibe\Shared\Domain\UuidValidator;

#[Route(
    path: '/fruits/{id}',
    name: 'veggievibe.api.fruit.search',
    methods: ['GET']
)]
final class FruitFinderController extends AbstractController
{
    public function __construct(
        private readonly SearchFruitById $searchFruitById,
        private readonly UuidValidator $uuidValidator,
    ) {
    }

    public function __invoke(string $id): Response
    {
        if (!$this->uuidValidator->isValid($id)) {
            return new JsonResponse(['error' => 'Invalid UUID'], 400);
        }
  
        $fruitResponse = $this->searchFruitById->__invoke(new FruitId($id));
        if (!$fruitResponse) {
            return new JsonResponse(['error' => 'Fruit not found'], 404);
        }

        return new JsonResponse(
            [
                'id' => $fruitResponse->id(),
                'name' => $fruitResponse->name(),
                'quantity' => $fruitResponse->quantity(),
                'unit' => $fruitResponse->unit(),
            ],
            200
        );
    }
}