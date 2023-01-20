<?php

namespace App\Controller\Trolley;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;
use App\Trolley\Trolley\Application\Create\CreateTrolleyCommand;
use App\Trolley\Trolley\Domain\TrolleyId;
use App\Trolley\Trolley\Domain\TrolleyPersonId;
use App\Trolley\Trolley\Domain\TrolleyState;
use App\Trolley\Trolley\Domain\TrolleyStates;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateTrolleyPostController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus){

    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->toArray();

        if ($this->fieldsAreNotProper($data)) {
            throw new \Exception('Fields are not properly fulfilled');
        }

        try{
            $this->commandBus->dispatch(
                CreateTrolleyCommand::create(
                    new TrolleyId(Uuid::random()->value()),
                    new TrolleyPersonId($data['personId']),
                    new TrolleyState(TrolleyStates::Active->value)
                )
            );

            return new JsonResponse('Trolley properly created');

        } catch (\Exception $e){
            throw new \Exception('Trolley couldn\'t be created: ' . $e->getMessage());
        }
    }

    private function fieldsAreNotProper(array $fields): bool
    {
        if (isset($fields['personId'])){
            return false;
        }

        return true;
    }
}