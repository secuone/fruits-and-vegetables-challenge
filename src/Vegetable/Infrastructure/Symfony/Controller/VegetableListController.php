<?php

namespace VeggieVibe\Vegetable\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use VeggieVibe\Vegetable\Application\SearchAll\SearchAllVegetables;

#[Route(
    path: '/vegetables',
    name: 'veggievibe.api.vegetables',
    methods: ['GET']
)]
final class VegetableListController extends AbstractController
{
    public function __construct(
        private readonly SearchAllVegetables $searchAllVegetables
    ) {
    }

    public function __invoke(): Response
    {
        $vegetableResponse = $this->searchAllVegetables->__invoke();

        if (!$vegetableResponse) {
            return new JsonResponse(['error' => 'Vegetable not found'], 404);
        }

        return new JsonResponse(
            array_map(
                fn($vegetable) => [
                    'id' => $vegetable->id(),
                    'name' => $vegetable->name(),
                    'quantity' => $vegetable->quantity(),
                    'unit' => $vegetable->unit(),
                ],
                $vegetableResponse->vegetables()
            ),
            200
        );
    }
}