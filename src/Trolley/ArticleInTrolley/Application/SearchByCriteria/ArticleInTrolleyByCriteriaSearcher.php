<?php

declare(strict_types=1);

namespace SearchByCriteria;

use Domain\ArticleInTrolleyRepository;

final class ArticleInTrolleyByCriteriaSearcher
{
    public function __construct(public readonly ArticleInTrolleyRepository $trolleyRepository)
    {

    }

    public function execute(array $criteria): ?array
    {
        return $this->trolleyRepository->searchByCriteria($criteria);
    }
}