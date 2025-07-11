<?php

namespace Domain\Resource\Repositories;

use Application\Resource\DTO\ResourceFilter;
use Domain\Resource\Entities\Resource;

interface ResourceRepositoryInterface
{
    public function save(Resource $resource): Resource;

    public function paginate(int $page, int $perPage, ?ResourceFilter $filter = null): array;

    public function countAll(?ResourceFilter $filter = null): int;

    public function exists(int $id): bool;
}
