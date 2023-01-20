<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\Create;

use App\Trolley\Trolley\Domain\Trolley;
use App\Trolley\Trolley\Domain\TrolleyId;
use App\Trolley\Trolley\Domain\TrolleyPersonId;
use App\Trolley\Trolley\Domain\TrolleyState;
use App\Trolley\Trolley\Domain\TrolleyRepository;

final class TrolleyCreator
{
    public function __construct(private readonly TrolleyRepository $trolleyRepository)
    {

    }

    public function execute(
        TrolleyId       $id,
        TrolleyPersonId $personId,
        TrolleyState    $stateId,
    ): void {
        $this->trolleyRepository->save(
            Trolley::create(
                $id,
                $personId,
                $stateId
            )
        );
    }
}