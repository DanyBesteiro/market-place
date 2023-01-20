<?php

declare(strict_types=1);


use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;
use Domain\Article;
use Domain\ArticleId;
use Domain\ArticleRepository;

final class DoctrineArticleRepository extends DoctrineRepository implements ArticleRepository
{

    public function save(Article $article): void
    {
        $this->persist($article);
    }

    public function search(ArticleId $id): array
    {
        $result = $this->defaultQuery()
            ->where('article.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchByCriteria(array $criteria): ?array
    {
        $result = $this->defaultQuery();

        foreach ($criteria as $field => $value){
            $result->andWhere('article.'.$field.'.value =\'' .$value.'\'');
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
        return $this->repository( Article::class)
            ->createQueryBuilder('shipment')
            ->select(
                'article.name.value as id',
                'article.name.value as name',
            );
    }
}