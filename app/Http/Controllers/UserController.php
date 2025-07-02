<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;



Carbon::setLocale('ar');

class UserController extends Controller
{
  public function user_index() {
    $userId = auth()->id();

    // رسائل اليوم لهذا المستخدم
    $todayMessagesCount = Message::where('user_id', $userId)
                                ->whereDate('created_at', Carbon::today())
                                ->count();

    // إجمالي الرسائل لهذا المستخدم
    $totalMessagesCount = Message::where('user_id', $userId)->count();

    // الرسائل المميزة لهذا المستخدم
    $featuredMessagesCount = Message::where('user_id', $userId)
                                    ->where('is_featured', true)
                                    ->count();

    // آخر رسالة لهذا المستخدم
    $lastMessage = Message::where('user_id', $userId)
                          ->orderBy('created_at', 'desc')
                          ->first();

    // وقت آخر رسالة بصيغة "منذ 5 دقائق"
    $lastMessageTime = $lastMessage ? $lastMessage->created_at->diffForHumans() : 'لا توجد رسائل بعد';
    // الحصول على معرف المستخدم الحالي

   $messages = Message::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate(4);  // بدل get()
    $user_name = auth()->user()->username;
         
    return view('user.dashboard', [
        'user_name'=>$user_name,
        'todayMessagesCount'    => $todayMessagesCount,
        'totalMessagesCount'    => $totalMessagesCount,
        'featuredMessagesCount' => $featuredMessagesCount,
        'lastMessageTime'       => $lastMessageTime,
        'messages'=>$messages
    ]);
}


    public function user_inbox()
    {
        $messages = Message::where('user_id', auth()->id())
            ->latest()
            ->get()
            ->map(fn ($m) => [
                'id'          => $m->id,
                'content'     => $m->content,
                'is_read'     => $m->is_read,
                'is_featured' => $m->is_featured,
                'created_at'  => $m->created_at->format('h:i A'),
            ]);

        return view('user.inbox', compact('messages'));
    }

    public function toggleFeatured(Message $message)
    {
        // إن كان لديك سياسة (Policy) فعّالة اترك السطر، وإلا علّق عليه
        // $this->authorize('update', $message);

        if ($message->user_id !== auth()->id()) {
            return response()->json(['status' => 'forbidden'], 403);
        }

        $message->is_featured = ! $message->is_featured;
        $message->save();

        return response()->json([
            'status'      => 'ok',
            'is_featured' => $message->is_featured,
        ]);
    }

 public function user_profile()
    {
        return view('user.profile', ['user' => auth()->user()]);
    }


public function update_profile(Request $request)
{
    $user = auth()->user();

    $v = Validator::make($request->all(), [
        'name'     => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'bio'      => 'nullable|string',
        'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($v->fails()) {
        return back()->withErrors($v)->withInput();
    }

    $data = $v->validated();

    // حفظ الصورة في مجلد public/avatars مباشرة
    if ($request->hasFile('avatar')) {
        // حذف الصورة القديمة إن وجدت
        if ($user->avatar && file_exists(public_path('avatars/' . $user->avatar))) {
            unlink(public_path('avatars/' . $user->avatar));
        }

        $fileName = uniqid() . '.' . $request->file('avatar')->extension();
        $request->file('avatar')->move(public_path('avatars'), $fileName);
        $data['avatar'] = $fileName;
    }

    $user->update($data);

    return back()->with('success', '✅ تم تحديث الملف.');
}



    public function toggle(User $user)
{
    try {
        $user->update(['is_active' => !$user->is_active]);
        
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة المستخدم بنجاح'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'فشل في تحديث الحالة: ' . $e->getMessage()
        ], 500);
    }
}

public function destroy(User $user)
{
    try {
        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'تم حذف المستخدم بنجاح'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'فشل في حذف المستخدم: ' . $e->getMessage()
        ], 500);
    }
}


    public function user_settings() {
    return view('user.settings');
}



public function update_password(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'كلمة المرور الحالية غير صحيحة');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', '✅ تم تحديث كلمة المرور بنجاح');
}

public function deactivate_account(Request $request)
{
    $user = auth()->user();
    $user->is_active = false; // تأكد أن هذا الحقل موجود
    $user->save();

    return back()->with('success', 'تم تعطيل الحساب مؤقتاً');
}

public function delete_account(Request $request)
{
    $user = auth()->user();
    auth()->logout();
    $user->delete();

    return redirect('/')->with('success', 'تم حذف الحساب بنجاح.');
}


public function toggle_active(Request $request)
{
    $user = auth()->user();

    // قم بتبديل الحالة من مفعل إلى غير مفعل والعكس
    $user->is_active = !$user->is_active;
    $user->save();

    $message = $user->is_active
        ? '✅ تم إعادة تفعيل الحساب.'
        : '🚫 تم تعطيل الحساب مؤقتاً.';

    return back()->with('success', $message);
}



}
