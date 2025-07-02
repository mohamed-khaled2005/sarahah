<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;      // ← الاستيراد المفقود
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

     // اختيارى لو احتجت أى فحص إضافى

class ReportController extends Controller
{

public function store(Request $request)
{
    $validated = $request->validate([
        'message_id' => 'required|exists:messages,id',
        'reason'     => 'required|string|max:1000',
    ]);

    Report::create([
        'message_id' => $validated['message_id'],
        'reason'     => $validated['reason'],
        'user_id'    => Auth::id(), // ✅ هذه أهم نقطة
    ]);

    return response()->json(['success' => true]);
}

}
