<?php

namespace Interfaces\Http\Controllers;

use App\Http\Controllers\Controller;
use Application\Resource\DTO\ResourceFilter;
use Application\Resource\UseCases\PaginateResourceUseCase;
use Application\Resource\UseCases\StoreResourceUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Interfaces\Http\Requests\StoreResourceRequest;
use OpenApi\Attributes as OAT;

class ResourceController extends Controller
{
    #[
        OAT\Get(
            path: '/resources',
            operationId: 'getResourcesPagination',
            summary: 'Get resources list',
            tags: ['Resources'],
            parameters: [
                new OAT\Parameter(
                    name: 'page',
                    description: 'Page number',
                    in: 'query',
                    required: false,
                    schema: new OAT\Schema(type: 'integer', default: 1)
                ),
                new OAT\Parameter(
                    name: 'perPage',
                    description: 'Items per page',
                    in: 'query',
                    required: false,
                    schema: new OAT\Schema(type: 'integer', default: 10)
                ),
                new OAT\Parameter(
                    name: 'type',
                    description: 'Filter by resource type',
                    in: 'query',
                    required: false,
                    schema: new OAT\Schema(type: 'string')
                ),
                new OAT\Parameter(
                    name: 'search',
                    description: 'Filter by resource name and description',
                    in: 'query',
                    required: false,
                    schema: new OAT\Schema(type: 'string')
                )
            ],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'Success',
                    content: new OAT\JsonContent(ref: '#/components/schemas/PaginatedList')
                ),
            ]
        ),
    ]
    public function index(Request $request, PaginateResourceUseCase $paginateResourceUseCase): JsonResponse
    {
        $page = (int)$request->query('page', 1);
        $perPage = (int)$request->query('perPage', 10);

        $filter = new ResourceFilter(
            type: $request->query('type'),
            search: $request->query('search'),
        );

        return new JsonResponse(
            $paginateResourceUseCase->execute(
                $page,
                $perPage,
                $filter
            )
        );
    }

    #[
        OAT\Post(
            path: '/resources',
            operationId: 'storeResource',
            summary: 'Store resource',
            requestBody: new OAT\RequestBody(ref: '#/components/requestBodies/StoreResourceRequest'),
            tags: ['Resources'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'Success',
                    content: new OAT\JsonContent(ref: '#/components/schemas/ResourceResponse')
                ),
                new OAT\Response(
                    response: 422,
                    description: 'Validation error',
                    content: new OAT\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
                ),
            ]
        ),
    ]
    public function store(StoreResourceUseCase $storeResourceUseCase, StoreResourceRequest $request): JsonResponse
    {
        return new JsonResponse(
            $storeResourceUseCase->execute(
                $request->get('name'),
                $request->get('type'),
                $request->get('description'),
            )
        );
    }
}
