<?php

namespace Application\Resource\UseCases;

use Domain\Resource\Entities\Resource;
use Domain\Resource\Repositories\ResourceRepositoryInterface;

class StoreResourceUseCase
{
    public function __construct(private ResourceRepositoryInterface $repository)
    {
    }

    public function execute(string $name, string $type, ?string $description): Resource
    {
        $resource = new Resource($name, $type, $description);

        return $this->repository->save($resource);
    }
}
