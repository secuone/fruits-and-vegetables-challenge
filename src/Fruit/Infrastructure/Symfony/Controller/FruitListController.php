<?php

namespace VeggieVibe\Fruit\Infrastructure\Symfony\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use VeggieVibe\Fruit\Application\SearchAll\SearchAllFruits;

#[Route(
    path: '/fruits',
    name: 'veggievibe.api.fruits',
    methods: ['GET']
)]
final class FruitListController extends AbstractController
{
    public function __construct(
        private readonly SearchAllFruits $searchAllFruits
    ) {
    }

    public function __invoke(): Response
    {
        $fruitResponse = $this->searchAllFruits->__invoke();

        if (!$fruitResponse) {
            return new JsonResponse(['error' => 'Fruit not found'], 404);
        }

        return new JsonResponse(
            array_map(
                fn($fruit) => [
                    'id' => $fruit->id(),
                    'name' => $fruit->name(),
                    'quantity' => $fruit->quantity(),
                    'unit' => $fruit->unit(),
                ],
                $fruitResponse->fruits()
            ),
            200
        );
    }
}