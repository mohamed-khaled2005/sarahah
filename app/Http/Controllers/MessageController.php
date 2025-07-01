<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    protected function findUserByIdOrUsername($identifier)
    {
        if (is_numeric($identifier)) {
            return User::find($identifier);
        } else {
            return User::where('username', $identifier)->first();
        }
    }

    public function message_page($identifier)
    {
        $user = $this->findUserByIdOrUsername($identifier);
        if (!$user) {
            abort(404, 'المستخدم غير موجود.');
        }

        return view("global.static.message", ['user' => $user]);
    }

    public function send_message(Request $request, $identifier)
    {
        $user = $this->findUserByIdOrUsername($identifier);
        if (!$user) {
            return redirect()->back()->with('error', 'المستخدم غير موجود.');
        }

        $validated = $request->validate([
            'message-content' => 'required|string|max:1000',
        ]);

        $message = new Message();
        $message->user_id = $user->id;
        $message->content = $validated['message-content'];
        $message->save();

        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح!');
    }

     public function delete_message($id)
    {
        $user = auth()->user();
        $message = Message::where('id', $id)->where('user_id', $user->id)->first();

        if (!$message) {
            return response()->json(['error' => 'الرسالة غير موجودة أو غير مسموح لك بحذفها.'], 404);
        }

        $message->delete();

        return response()->json(['success' => 'تم حذف الرسالة بنجاح.']);
    }

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
}
