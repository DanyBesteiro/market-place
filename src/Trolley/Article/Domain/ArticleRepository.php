<?php

declare(strict_types=1);

namespace Domain;

interface ArticleRepository
{
    public function save(Article $shipment): void;
    public function search(ArticleId $id): array;
    public function searchByCriteria(array $criteria): ?array;
    public function searchAll(): array;
}
