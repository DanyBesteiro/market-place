<?php

declare(strict_types=1);

namespace Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Article extends AggregateRoot
{
    public function __construct(
        private ArticleId $id,
        private ArticleName $name,
    )
    {
    }

    public static function create(
        ArticleId $id,
        ArticleName $name,
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): ArticleId
    {
        return $this->id;
    }

    public function name(): ArticleName
    {
        return $this->name;
    }
}