<?php

namespace Application\Resource\UseCases;

use Application\Resource\DTO\ResourceFilter;
use Domain\Resource\Repositories\ResourceRepositoryInterface;
use Shared\Responses\PaginatedList;

class PaginateResourceUseCase
{
    public function __construct(private ResourceRepositoryInterface $repository)
    {
    }

    public function execute(int $page = 1, int $perPage = 10, ?ResourceFilter $filter = null): PaginatedList
    {
        $resources = $this->repository->paginate($page, $perPage, $filter);

        return new PaginatedList(
            $resources,
            $this->repository->countAll(),
            $page,
            $perPage
        );
    }
}
