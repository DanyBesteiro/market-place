<?php

declare(strict_types=1);

use \Domain\ArticleInTrolleyId;
use \Domain\ArticleInTrolleyArticleId;
use \Domain\ArticleInTrolleyTrolleyId;
use \Domain\ArticleInTrolleyUnits;

use \App\Shared\Domain\Bus\Command\Command;
final class CreateArticleInTrolleyCommand implements Command
{
    public function __construct(
        public readonly ArticleInTrolleyId $id,
        public readonly ArticleInTrolleyArticleId $articleId,
        public readonly ArticleInTrolleyTrolleyId $trolleyId,
        public readonly ArticleInTrolleyUnits $units,
    ) {
    }

    public static function create(
        ArticleInTrolleyId $id,
        ArticleInTrolleyArticleId $articleId,
        ArticleInTrolleyTrolleyId $trolleyId,
        ArticleInTrolleyUnits $units,
    ): self {
        return new self(
            $id,
            $articleId,
            $trolleyId,
            $units
        );
    }
}