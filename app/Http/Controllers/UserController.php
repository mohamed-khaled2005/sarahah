<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\message;
use Carbon\Carbon;
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

    public function user_inbox() {
    return view('user.inbox');
}
    public function user_profile() {
    return view('user.profile');
}
    public function user_statistics() {
    return view('user.statistics');
}
    public function user_settings() {
    return view('user.settings');
}
}
