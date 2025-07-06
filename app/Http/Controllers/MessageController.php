<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * إيجاد مستخدم عبر ID أو username
     */
    protected function findUserByIdOrUsername($identifier)
    {
        if (is_numeric($identifier)) {
            return User::find($identifier);
        } else {
            return User::where('username', $identifier)->first();
        }
    }

    /**
     * صفحة إرسال رسالة للمستخدم
     */
    public function message_page($identifier)
    {
        $user = $this->findUserByIdOrUsername($identifier);

        // المستخدم غير موجود أو معطّل
        if (!$user || !$user->is_active) {
            abort(404, 'هذا المستخدم غير متاح حالياً.');
        }

        return view("global.static.message", ['user' => $user]);
    }

    /**
     * إرسال رسالة للمستخدم
     */
public function send_message(Request $request, $identifier)
{
    $user = $this->findUserByIdOrUsername($identifier);

    if (!$user || !$user->is_active) {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => false, 'message' => 'لا يمكن إرسال رسالة لهذا المستخدم.'], 404);
        }
        return redirect()->back()->with('error', 'لا يمكن إرسال رسالة لهذا المستخدم.');
    }

    $validated = $request->validate([
        'message-content' => 'required|string|max:1000',
    ]);

    $message = new \App\Models\Message();
    $message->user_id = $user->id;
    $message->content = $validated['message-content'];
    $message->save();

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'تم إرسال الرسالة بنجاح!',
            'reset_form' => true
        ]);
    }

    return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح!');
}
    /**
     * حذف رسالة خاصة بالمستخدم المسجّل
     */
    public function delete_message($id)
    {
        $user = auth()->user();
        $message = Message::where('id', $id)
                          ->where('user_id', $user->id)
                          ->first();

        if (!$message) {
            return response()->json(['error' => 'الرسالة غير موجودة أو غير مسموح لك بحذفها.'], 404);
        }

        $message->delete();

        return response()->json(['success' => 'تم حذف الرسالة بنجاح.']);
    }

    /**
     * وضع علامة "مقروءة" على رسالة
     */
    public function markRead($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['success' => false], 404);
        }

        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['success' => false, 'message' => 'الرسالة غير موجودة'], 404);
        }

        $message->delete();

        return response()->json(['success' => true, 'message' => 'تم حذف الرسالة بنجاح']);
    }
}
