<?php

declare(strict_types=1);

namespace App\Trolley\ArticleInTrolley\Infrastructure\Persistence;

use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;
use Domain\ArticleInTrolley;
use Domain\ArticleInTrolleyId;
use Domain\ArticleInTrolleyRepository;

final class DoctrineArticleInTrolleyRepository extends DoctrineRepository implements ArticleInTrolleyRepository
{
    public function save(ArticleInTrolley $articleInTrolley): void
    {
        $this->persist($articleInTrolley);
    }
    public function search(ArticleInTrolleyId $id): array
    {
        $result = $this->defaultQuery()
            ->where('articleInTrolley.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }
    public function searchByCriteria(array $criteria): ?array
    {
        $result = $this->defaultQuery();

        foreach ($criteria as $field => $value){
            $result->andWhere('articleInTrolley.'.$field.'.value =\'' .$value.'\'');
        }

        $final = $result->getQuery()->getArrayResult();

        return empty($final) ? null : $final;
    }
    public function searchAll(): array
    {
        return $this->defaultQuery()
            ->getQuery()
            ->getArrayResult();
    }
    private function defaultQuery(): QueryBuilder
    {
        return $this->repository( ArticleInTrolley::class)
            ->createQueryBuilder('shipment')
            ->select(
                'articleInTrolley.id.value as id',
                'articleInTrolley.articleId.value as articleId',
                'articleInTrolley.trolleyId.value as trolleyId',
                'articleInTrolley.units.value as units'
            );
    }
}