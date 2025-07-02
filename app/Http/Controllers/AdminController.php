<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\message;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Event;



class AdminController extends Controller
{
       // admin_pages
    public function admin_index() {
        app()->setLocale('ar');
        $events = Event::latest()->take(40)->get();
        $users_number=User::count();
        $daily_messages_number=Message::where('created_at', '>=', Carbon::now()->subDay())->count();
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $totalMessagesLastWeek = Message::where('created_at', '>=', $sevenDaysAgo)->count();
        $dailyMessages = Message::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('created_at', '>=', $sevenDaysAgo)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->pluck('count', 'date');

        /*----------> النسب <---------------------- */
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

// رسائل اليوم
        $currentDayCount = Message::whereDate('created_at', $today)->count();

// رسائل أمس
        $previousDayCount = Message::whereDate('created_at', $yesterday)->count();

// حساب النسبة
        $dailyChange = 0;
            if ($previousDayCount > 0) {
        $dailyChange = (($currentDayCount - $previousDayCount) / $previousDayCount) * 100;
        }

        $now = Carbon::now();

        $sevenDaysAgo = $now->copy()->subDays(7);
        $fourteenDaysAgo = $now->copy()->subDays(14);

// آخر 7 أيام
        $currentWeekCount = Message::where('created_at', '>=', $sevenDaysAgo)->count();

// الأسبوع السابق (من 14 يوم إلى 7 أيام مضت)
        $previousWeekCount = Message::whereBetween('created_at', [$fourteenDaysAgo, $sevenDaysAgo])->count();

// حساب النسبة
        $weeklyChange = 0;
        if ($previousWeekCount > 0) {
    $weeklyChange = (($currentWeekCount - $previousWeekCount) / $previousWeekCount) * 100;
        }
        // الشهر الحالي
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

// الشهر السابق
        $previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();

// المستخدمون الجدد في الشهر الحالي
        $currentMonthUsers = User::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();

// الشهر السابق
        $previousMonthUsers = User::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();

// النسبة
        $monthlyChange = 0;
            if ($previousMonthUsers > 0) {
         $monthlyChange = (($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100;
        }
// حساب النسبة اليومية كنص
if ($previousDayCount > 0) {
    $dailyChange = (($currentDayCount - $previousDayCount) / $previousDayCount) * 100;
} else {
    $dailyChange = 0;
}
$dailyChangeString = ($dailyChange > 0 ? '+' : '') . round($dailyChange, 2) . '%';

// حساب النسبة الأسبوعية كنص
if ($previousWeekCount > 0) {
    $weeklyChange = (($currentWeekCount - $previousWeekCount) / $previousWeekCount) * 100;
} else {
    $weeklyChange = 0;
}
$weeklyChangeString = ($weeklyChange > 0 ? '+' : '') . round($weeklyChange, 2) . '%';

// حساب النسبة الشهرية كنص
if ($previousMonthUsers > 0) {
    $monthlyChange = (($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100;
} else {
    $monthlyChange = 0;
}
$monthlyChangeString = ($monthlyChange > 0 ? '+' : '') . round($monthlyChange, 2) . '%';


// إجمالي الرسائل المُبلَّغ عنها
$reports_count = Report::count();

// الرسائل المبلّغ عنها هذا الشهر
$reportsCurrentMonth = Report::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();

// الرسائل المبلّغ عنها الشهر السابق
$reportsPreviousMonth = Report::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();

// نسبة التغيير
$reportsMonthlyChange = 0;
if ($reportsPreviousMonth > 0) {
    $reportsMonthlyChange = (($reportsCurrentMonth - $reportsPreviousMonth) / $reportsPreviousMonth) * 100;
}
$reportsMonthlyChangeString = ($reportsMonthlyChange > 0 ? '+' : '') . round($reportsMonthlyChange, 2) . '%';

return view('admin.dashboard', [
    'dailyMessages' => $dailyMessages,
    'users_number'=>   $users_number,
    'daily_messages_number' => $daily_messages_number,
    'totalMessagesLastWeek' =>$totalMessagesLastWeek,
    'currentDayCount' => $currentDayCount,
    'dailyChange' => $dailyChangeString,

    'currentWeekCount' => $currentWeekCount,
    'weeklyChange' => $weeklyChangeString,

    'currentMonthUsers' => $currentMonthUsers,
    'monthlyChange' => $monthlyChangeString,

    // المتغيرات الجديدة
    'reports_count' => $reports_count,
    'reportsMonthlyChange' => $reportsMonthlyChangeString,
    'events'=>$events,
]);
}


    public function admin_users() {
    return view('admin.users');
}
    public function admin_messages() {
    return view('admin.messages');
}
    public function admin_posts() {
    return view('admin.posts');
}
    public function admin_reports() {
    return view('admin.reports');
}
    public function admin_ads() {
    return view('admin.ads');
}
    public function admin_settings() {
    return view('admin.settings');
}
}
