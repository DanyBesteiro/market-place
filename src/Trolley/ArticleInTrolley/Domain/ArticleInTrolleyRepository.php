<?php

declare(strict_types=1);

namespace Domain;

interface ArticleInTrolleyRepository
{
    public function save(ArticleInTrolley $articleInTrolley): void;
    public function search(ArticleInTrolleyId $id): array;
    public function searchByCriteria(array $criteria): ?array;
    public function searchAll(): array;
}
