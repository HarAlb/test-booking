<?php

namespace Infrastructure\Resource\QueryFilters;

use Application\Resource\DTO\ResourceFilter;
use Domain\Resource\QueryFilters\ResourceQueryFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class ResourceQueryFilter implements ResourceQueryFilterInterface
{
    public function apply(Builder $query, ResourceFilter $filter): Builder
    {
        if ($filter->type !== null) {
            $query->where('type', $filter->type);
        }

        if ($filter->search !== null) {
            $search = '%' . $filter->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        }

        return $query;
    }
}
