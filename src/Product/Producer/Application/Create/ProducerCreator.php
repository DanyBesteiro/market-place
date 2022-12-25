<?php

declare(strict_types=1);

namespace App\Product\Producer\Application\Create;

use App\Product\Producer\Domain\Producer;
use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\ProducerName;
use App\Product\Producer\Domain\ProducerRepository;

final class ProducerCreator
{
    public function __construct(
        private readonly ProducerRepository $producerRepository
    ){

    }

    public function execute(ProducerId $id, ProducerName $name): void
    {
        $this->producerRepository->save(Producer::create($id, $name));
    }
}