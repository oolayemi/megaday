<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function myNotifications(): JsonResponse
    {
        $user = \request()->user();
        $notifications = $user->notifications?->toArray() ?? [];
        return ApiResponse::success("Notifications fetched successfully", $notifications);
    }

    public function viewNotification(string $id): JsonResponse
    {
        $notification = Notification::query()->find($id);

        if (! $notification?->exists()) {
            return ApiResponse::failed("The selected notification does not exist", 404);
        }

        $notification->is_read = true;
        $notification->save();

        return ApiResponse::success("Notification retrieved successfully", $notification->toArray());
    }

    public function markAllAsRead(): JsonResponse
    {
        \request()->user()->notifications()->update(['is_read' => true]);
        return ApiResponse::success("Notifications marked as read successfully");
    }
}
