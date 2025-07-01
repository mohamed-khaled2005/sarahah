<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markRead(): JsonResponse
    {
        // حدّث كل الرسائل غير المقروءة لهذا المستخدم
        $affected = Auth::user()->messages()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'status'      => 'success',
            'unreadCount' => 0,
            'affected'    => $affected,
        ]);
    }
}