<?php

namespace Domain\Resource\QueryFilters;

use Application\Resource\DTO\ResourceFilter;
use Illuminate\Database\Eloquent\Builder;

interface ResourceQueryFilterInterface
{
    public function apply(Builder $query, ResourceFilter $filter): Builder;
}
