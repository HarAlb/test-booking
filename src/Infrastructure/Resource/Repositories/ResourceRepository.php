<?php

namespace Infrastructure\Resource\Repositories;

use Application\Resource\DTO\ResourceFilter;
use Domain\Resource\Entities\Resource;
use Domain\Resource\QueryFilters\ResourceQueryFilterInterface;
use Infrastructure\Resource\Models\Resource as ResourceModel;
use Domain\Resource\Repositories\ResourceRepositoryInterface;

class ResourceRepository implements ResourceRepositoryInterface
{

    public function __construct(private ResourceQueryFilterInterface $filter)
    {
    }

    public function save(Resource $resource): Resource
    {
        $model = new ResourceModel();

        $model->name = $resource->getName();
        $model->type = $resource->getType();
        $model->description = $resource->getDescription();

        $model->save();

        $resource->setId($model->id);
        $resource->setCreatedAt($model->created_at?->toDateTimeImmutable());
        $resource->setUpdatedAt($model->updated_at?->toDateTimeImmutable());

        return $resource;
    }

    public function paginate(int $page, int $perPage, ?ResourceFilter $filter = null): array
    {
        $query = ResourceModel::query();

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->paginate(perPage: $perPage, page: $page)
            ->getCollection()
            ->map(function ($model) {
                $resource = new Resource(
                    $model->name,
                    $model->type,
                    $model->description,
                    $model->created_at?->toDateTimeImmutable(),
                    $model->updated_at?->toDateTimeImmutable()
                );

                $resource->setId($model->id);

                return $resource;
            })
            ->all();
    }

    public function countAll(?ResourceFilter $filter = null): int
    {
        $query = ResourceModel::query();

        if ($filter) {
            $this->filter->apply($query, $filter);
        }

        return $query->count();
    }

    public function exists(int $id): bool
    {
        return ResourceModel::where('id', $id)->exists();
    }
}
