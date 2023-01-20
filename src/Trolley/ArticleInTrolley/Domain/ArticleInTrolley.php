<?php

declare(strict_types=1);

namespace Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class ArticleInTrolley extends AggregateRoot
{
    public function __construct(
        private ArticleInTrolleyId        $id,
        private ArticleInTrolleyArticleId $articleId,
        private ArticleInTrolleyTrolleyId $trolleyId,
        private ArticleInTrolleyUnits     $units,
    )
    {
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
            $units,
        );
    }

    public function id(): ArticleInTrolleyId
    {
        return $this->id;
    }

    public function articleId(): ArticleInTrolleyArticleId
    {
        return $this->articleId;
    }

    public function trolleyId(): ArticleInTrolleyTrolleyId
    {
        return $this->trolleyId;
    }

    public function units(): ArticleInTrolleyUnits
    {
        return $this->units;
    }
}