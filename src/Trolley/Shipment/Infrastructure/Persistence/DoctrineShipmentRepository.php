<?php

declare(strict_types=1);

namespace App\Trolley\Shipment\Infrastructure\Persistence;

use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;
use Domain\Shipment;
use Domain\ShipmentId;
use Domain\ShipmentRepository;

final class DoctrineShipmentRepository extends DoctrineRepository implements ShipmentRepository
{

    public function save(Shipment $shipment): void
    {
        $this->persist($shipment);
    }

    public function find(Shipment $id): Shipment
    {
        return $this->repository(Shipment::class)->findOneBy(['id.value' => $id->value()]);
    }

    public function search(ShipmentId $id): array
    {
        $result = $this->defaultQuery()
            ->where('shipment.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchByCriteria(array $criteria): ?array
    {
        $result = $this->defaultQuery();

        foreach ($criteria as $field => $value){
            $result->andWhere('shipment.'.$field.'.value =\'' .$value.'\'');
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
        return $this->repository( Shipment::class)
            ->createQueryBuilder('shipment')
            ->select(
                'shipment.id.value as id',
                'shipment.personAddressId.value as personAddressId',
                'shipment.trolleyId.value as trolleyId',
                'shipment.state.value as state'
            );
    }
}