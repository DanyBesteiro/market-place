<?php

declare(strict_types=1);

namespace Domain;

interface ShipmentRepository
{
    public function save(Shipment $shipment): void;
    public function search(ShipmentId $id): array;
    public function searchByCriteria(array $criteria): ?array;
    public function searchAll(): array;
}
