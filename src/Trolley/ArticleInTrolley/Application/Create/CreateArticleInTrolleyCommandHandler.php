<?php

declare(strict_types=1);

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Trolley\Trolley\Application\SearchByCriteria\SearchTrolleyByCriteriaQuery;
use App\Trolley\Trolley\Domain\TrolleyStates;

use SearchByCriteria\SearchArticleInTrolleyByCriteriaQuery;

final class CreateArticleInTrolleyCommandHandler implements CommandHandler
{
    private const N_ARTICLES_ALLOWED = 3;
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly ArticleInTrolleyCreator $creator
    )
    {
    }

    public function __invoke(CreateArticleInTrolleyCommand $command): void
    {
        if ($this->articleAndTrolleyComplyWithTheConditions($command->trolleyId->value())) {
            $this->creator->execute(
                $command->id,
                $command->articleId,
                $command->trolleyId,
                $command->units
            );
        }
    }


    private function articleAndTrolleyComplyWithTheConditions(string $trolleyId): bool
    {
        $activeTrolleys = $this->queryBus->ask(
            SearchTrolleyByCriteriaQuery::create([
                'id' => $trolleyId,
                'state' => TrolleyStates::Finalized->value])
        );

        if (!is_null($activeTrolleys)){
            throw new \Exception('This trolley is already finalized. Add articles is not allowed');
        }

        $articlesInTrolley = $this->queryBus->ask(
            SearchArticleInTrolleyByCriteriaQuery::create([
                'trolleyId' => $trolleyId
            ])
        );

        if ( self::N_ARTICLES_ALLOWED <= count($articlesInTrolley)){
            throw new \Exception('This trolley already have '. self::N_ARTICLES_ALLOWED . '. Add more articles is not allowed');
        }

        return true;
    }
}