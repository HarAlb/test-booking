<?php

namespace Infrastructure\Booking\Repositories;

use Domain\Booking\Entities\Booking;
use Domain\Booking\Repositories\BookingRepositoryInterface;
use Infrastructure\Booking\Models\Booking as BookingModel;

class BookingRepository implements BookingRepositoryInterface
{
    public function save(Booking $booking): Booking
    {
        $model = new BookingModel();

        $model->resource_id = $booking->getResourceId();
        $model->user_id = $booking->getUserId();
        $model->start_time = $booking->getStartTime();
        $model->end_time = $booking->getEndTime();

        $model->save();

        $booking->setId($model->id);
        $booking->setCreatedAt($model->created_at?->toDateTimeImmutable());
        $booking->setUpdatedAt($model->updated_at?->toDateTimeImmutable());

        return $booking;
    }

    public function checkUserBookingConflict(int $userId, \DateTimeImmutable $start, \DateTimeImmutable $end): bool
    {
        return BookingModel::where('user_id', $userId)
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('start_time', [$start, $end])
                    ->orWhereBetween('end_time', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_time', '<=', $start)
                            ->where('end_time', '>=', $end);
                    });
            })
            ->exists();
    }

    public function getByResource(int $resourceId): array
    {
        return BookingModel::where('resource_id', $resourceId)
            ->get()
            ->map(function ($model) {
                $booking = new Booking(
                    $model->resource_id,
                    $model->user_id,
                    $model->start_time->toDateTimeImmutable(),
                    $model->end_time->toDateTimeImmutable()
                );
                $booking->setId($model->id);
                $booking->setCreatedAt($model->created_at?->toDateTimeImmutable());
                $booking->setUpdatedAt($model->updated_at?->toDateTimeImmutable());
                return $booking;
            })
            ->all();
    }

    public function destroy(int $id): void
    {
        BookingModel::where('id', $id)->delete();
    }

    public function findByIdAndUserId(int $id, int $userId): ?Booking
    {
        $model = BookingModel::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$model) {
            return null;
        }

        $booking = new Booking(
            $model->resource_id,
            $model->user_id,
            $model->start_time->toDateTimeImmutable(),
            $model->end_time->toDateTimeImmutable(),
        );

        $booking->setId($model->id);
        $booking->setCreatedAt($model->created_at?->toDateTimeImmutable());
        $booking->setUpdatedAt($model->updated_at?->toDateTimeImmutable());

        return $booking;
    }
}
