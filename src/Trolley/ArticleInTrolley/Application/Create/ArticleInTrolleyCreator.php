<?php

declare(strict_types=1);

use Domain\ArticleInTrolleyRepository;
use Domain\ArticleInTrolley;
use \Domain\ArticleInTrolleyId;
use \Domain\ArticleInTrolleyArticleId;
use \Domain\ArticleInTrolleyTrolleyId;
use \Domain\ArticleInTrolleyUnits;

final class ArticleInTrolleyCreator
{
    public function __construct(private readonly ArticleInTrolleyRepository $trolleyRepository)
    {

    }

    public function execute(
        ArticleInTrolleyId $id,
        ArticleInTrolleyArticleId $articleId,
        ArticleInTrolleyTrolleyId $trolleyId,
        ArticleInTrolleyUnits $units,
    ): void {
        $this->trolleyRepository->save(
            ArticleInTrolley::create(
                $id,
                $articleId,
                $trolleyId,
                $units
            )
        );
    }
}