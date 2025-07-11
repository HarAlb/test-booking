<?php

namespace Application\Resource\DTO;

class ResourceFilter
{
    public function __construct(
        public ?string $type = null,
        public ?string $search = null,
    ) {}
}
