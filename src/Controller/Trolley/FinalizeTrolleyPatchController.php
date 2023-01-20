<?php

namespace App\Controller\Trolley;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Trolley\Trolley\Application\Update\FinalizeTrolleyCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FinalizeTrolleyPatchController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus){

    }

    public function __invoke(string $trolleyId, Request $request): JsonResponse
    {
        try{
            $data = $request->toArray();

            $this->commandBus->dispatch(
                FinalizeTrolleyCommand::create($data['addressId'], $trolleyId)
            );

            return new JsonResponse('Trolley properly finalized.');

        } catch (\Exception $e){
            throw new \Exception('Trolley couldn\'t be finalized: ' . $e->getMessage());
        }
    }
}