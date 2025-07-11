<?php

namespace Interfaces\Http\Controllers;

use App\Http\Controllers\Controller;
use Application\Booking\UseCases\DestroyBookingUseCase;
use Application\Booking\UseCases\GetBookingsByResourceUseCase;
use Application\Booking\UseCases\StoreBookingUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Interfaces\Http\Requests\StoreBookingRequest;
use OpenApi\Attributes as OAT;

class BookingController extends Controller
{
    #[
        OAT\Post(
            path: '/bookings',
            operationId: 'storeBooking',
            summary: 'Store booking',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(ref: '#/components/requestBodies/StoreBookingRequest'),
            tags: ['Booking'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'Success',
                    content: new OAT\JsonContent(ref: '#/components/schemas/BookingResponse')
                ),
                new OAT\Response(
                    response: 422,
                    description: 'Validation error',
                    content: new OAT\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
                ),
                new OAT\Response(
                    response: 409,
                    description: 'Booking conflict - the user already has a booking in the selected period',
                    content: new OAT\JsonContent(
                        properties: [
                            new OAT\Property(property: 'message', type: 'string', example: 'Booking conflict: The user already has a booking in the selected period.')
                        ]
                    )
                ),
                new OAT\Response(
                    response: 404,
                    description: 'Resource not found',
                    content: new OAT\JsonContent(
                        properties: [
                            new OAT\Property(property: 'message', type: 'string', example: 'Resource Not found')
                        ]
                    )
                ),
            ]
        ),
    ]
    public function store(StoreBookingUseCase $storeBookingUseCase, StoreBookingRequest $request): JsonResponse
    {
        return new JsonResponse(
            $storeBookingUseCase->execute(
                $request->get('resource_id'),
                $request->user()->id,
                new \DateTimeImmutable($request->get('start_time')),
                new \DateTimeImmutable($request->get('end_time')),
            )
        );
    }

    #[
        OAT\Get(
            path: '/resources/{id}/bookings',
            operationId: 'getBookingsByResource',
            summary: 'Get bookings for a specific resource',
            tags: ['Booking'],
            parameters: [
                new OAT\Parameter(
                    name: 'id',
                    description: 'Resource ID',
                    in: 'path',
                    required: true,
                    schema: new OAT\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'List of bookings',
                    content: new OAT\JsonContent(
                        type: 'array',
                        items: new OAT\Items(ref: '#/components/schemas/BookingResponse')
                    )
                ),
                new OAT\Response(
                    response: 404,
                    description: 'Resource not found',
                    content: new OAT\JsonContent(
                        properties: [
                            new OAT\Property(property: 'message', type: 'string', example: 'Resource Not found')
                        ]
                    )
                ),
            ]
        )
    ]
    public function getByResource(int $id, GetBookingsByResourceUseCase $useCase): JsonResponse
    {
        return new JsonResponse($useCase->execute($id));
    }


    #[
        OAT\Delete(
            path: '/bookings/{id}',
            operationId: 'destroyBooking',
            summary: 'Destroy booking by ID',
            security: [['bearerAuth' => []]],
            tags: ['Booking'],
            parameters: [
                new OAT\Parameter(
                    name: 'id',
                    description: 'Booking ID',
                    in: 'path',
                    required: true,
                    schema: new OAT\Schema(type: 'integer')
                ),
            ],
            responses: [
                new OAT\Response(
                    response: 204,
                    description: 'Booking successfully deleted'
                ),
                new OAT\Response(response: 401, description:'Unauthorized'),
                new OAT\Response(response: 403, description:'Permission denied'),
            ]
        )
    ]
    public function destroy(int $id, DestroyBookingUseCase $case): Response
    {
        $case->execute($id, auth()->user()->id);

        return response()->noContent();
    }
}
