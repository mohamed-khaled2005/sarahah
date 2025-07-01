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
}
