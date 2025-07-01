<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\message;
use App\Models\User;

class MessageController extends Controller
{
    public function message_page($id)
    {
    return view("global.static.message", ['id' => $id]);
    }

    public function send_message(Request $request, $id)
{
    // تحقق أن المستخدم موجود
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'المستخدم غير موجود.');
    }

    // تحقق من صحة البيانات
    $validated = $request->validate([
        'message-content' => 'required|string|max:1000',
    ]);

    // إنشاء الرسالة
    $message = new Message();
    $message->user_id = $id;
    $message->content = $validated['message-content'];
    $message->save();

    // إعادة توجيه مع رسالة نجاح
    return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح!');
}

}
