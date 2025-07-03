<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\Report;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Models\Ad;
use App\Models\Page;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ... admin_pages functions ...
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


        // إجمالي الرسائل المُبلَّغ عنها
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

        $messages = Message::latest()->get();

        return view('admin.messages',['messages'=>$messages]);

    }
public function admin_posts() {
    $posts = Post::all();
    return view('admin.posts', [
        "posts" => $posts
    ]);
}

public function edit_post($id)
{
    $post = Post::findOrFail($id);

    return response()->json([
        'title'         => $post->title,
        'slug'          => $post->slug,
        'content'       => $post->content,
        'status'        => $post->status,
        'author'        => $post->author,
        'category'      => $post->category,
        'thumbnail_url' => $post->thumbnail ? asset('avatars/' . $post->thumbnail) : null,
    ]);
}

public function update_post(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'title'     => 'required|string|max:255',
        'slug'      => 'required|string|max:255|unique:posts,slug,' . $id,
        'content'   => 'required|string',
        'status'    => 'required|in:draft,published',
        'author'    => 'required|string|max:255',
        'category'  => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $data = $request->only(['title', 'slug', 'content', 'status', 'author', 'category']);

    if ($request->hasFile('thumbnail')) {
        // حذف الصورة القديمة إن وجدت فعلاً
        if ($post->thumbnail && file_exists(public_path('avatars/' . $post->thumbnail))) {
            @unlink(public_path('avatars/' . $post->thumbnail));
        }

        $file = $request->file('thumbnail');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('avatars'), $fileName);

        $data['thumbnail'] = $fileName;
    }

    $post->update($data);

    return response()->json([
        'success' => true,
        'message' => 'تم تحديث المقال بنجاح'
    ]);
}

public function destroy_post($id)
{
    $post = Post::findOrFail($id);

    // حذف الصورة إن وجدت فعلاً
    if ($post->thumbnail && file_exists(public_path('avatars/' . $post->thumbnail))) {
        @unlink(public_path('avatars/' . $post->thumbnail));
    }

    $post->delete();

    return response()->json([
        'success' => true,
        'message' => 'تم حذف المقال بنجاح'
    ]);
}

public function store_post(Request $request)
{
    $validated = $request->validate([
        'title'     => 'required|string|max:255',
        'slug'      => 'required|string|max:255|unique:posts,slug',
        'content'   => 'required|string',
        'status'    => 'required|in:draft,published',
        'author'    => 'required|string|max:255',
        'category'  => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
    ]);

    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('avatars'), $fileName);

        $validated['thumbnail'] = $fileName;
    }

    $post = Post::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'تم إنشاء المقال بنجاح',
        'post'    => $post
    ]);
}



    public function admin_reports() {

        $messages = Message::latest()->get();
        $reports = Report::latest()->get();

        return view('admin.reports',[

            'messages'=>$messages,
            'reports'=>$reports,

        ]);

    }

    private $adTypes = [
        'top_banner_ad'     => 'إعلان الراية العلوية',
        'right_sidebar_ad'  => 'إعلان الشريط الأيمن',
        'left_sidebar_ad'   => 'إعلان الشريط الأيسر',
        'in_content_ad'     => 'إعلان داخل المحتوى',
        'footer_ad'         => 'إعلان تذييل الصفحة',
    ];

    public function admin_ads() {
          
        // التأكد من وجود جميع الإعلانات الأساسية في قاعدة البيانات
        foreach ($this->adTypes as $dbName => $displayName) {
            Ad::firstOrCreate(
                ['name' => $dbName], // الشرط للبحث عن الإعلان بالاسم الإنجليزي
                ['code' => null, 'active' => false] // البيانات التي سيتم استخدامها إذا تم إنشاء الإعلان
            );
        }

        // جلب جميع الإعلانات الآن بعد التأكد من وجودها
        // لا نحتاج هنا لجلبها بأسماء العرض العربية، الأسماء الإنجليزية ستكفي
        $ads = Ad::all();

        // تمرير الإعلانات وقائمة الأنواع (بالأسماء العربية) إلى الـ View
        return view('admin.ads', [
            'ads' => $ads,
            'adTypes' => $this->adTypes // نمرر هذه القائمة لإنشاء التابات بشكل صحيح
        ]);
    }
 public function show_ads(Request $request)
    {
        $adName = $request->query('name'); // الاسم الإنجليزي للإعلان المطلوب

        // التحقق مما إذا كان الاسم المطلوب موجودًا في قائمة الأنواع المسموح بها
        if (!array_key_exists($adName, $this->adTypes)) {
            return response()->json(['message' => 'نوع الإعلان غير صالح.'], 400);
        }

        $ad = Ad::where('name', $adName)->first();

        if (!$ad) {
            // هذا السيناريو يجب ألا يحدث إذا تم تهيئة الإعلانات في index()
            return response()->json(['message' => 'الإعلان غير موجود.'], 404);
        }

        return response()->json($ad);
    }

    public function update_ads(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        $adName = $request->input('name');

        // التحقق مما إذا كان الاسم المطلوب موجودًا في قائمة الأنواع المسموح بها
        if (!array_key_exists($adName, $this->adTypes)) {
            return response()->json(['message' => 'نوع الإعلان غير صالح.'], 400);
        }

        $ad = Ad::where('name', $adName)->first();

        if (!$ad) {
            return response()->json(['message' => 'الإعلان غير موجود أو لا يمكنك تحديث إعلان غير موجود بهذه الطريقة.'], 404);
        }

        $ad->code = $request->code;
        $ad->active = $request->active;
        $ad->save();

        return response()->json(['success' => true, 'message' => 'تم حفظ الإعلان بنجاح!']);
    }

    
    // عرض كل الصفحات
    public function admin_pages() {
        $pages = Page::latest()->get();
        return view('admin.pages', compact('pages'));
    }

    // إضافة صفحة جديدة
    public function pages_store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => ['required', Rule::in(['draft', 'published'])],
            'slug' => 'nullable|string|max:255|unique:pages,slug',
        ]);

        // توليد slug إذا لم يُرسل
        $slug = $request->input('slug') ?: Str::slug($request->input('title'));

        // التأكد أن slug فريد
        $originalSlug = $slug;
        $counter = 1;
        while (Page::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        Page::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'slug' => $slug,
        ]);

        return response()->json(['success' => true, 'message' => 'تم إضافة الصفحة بنجاح!']);
    }

    // جلب بيانات صفحة واحدة
    public function pages_getpagedata(Page $page) {
        return response()->json([
            'id' => $page->id,
            'title' => $page->title,
            'content' => $page->content,
            'status' => $page->status,
            'slug' => $page->slug,
        ]);
    }

    // تحديث صفحة موجودة
    public function update_pages(Request $request, Page $page) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'status' => ['required', Rule::in(['draft', 'published'])],
            'slug' => [
                'nullable', 'string', 'max:255',
                Rule::unique('pages', 'slug')->ignore($page->id),
            ],
        ]);

        // توليد slug إذا لم يُرسل
        $slug = $request->input('slug') ?: Str::slug($request->input('title'));

        // التأكد أن slug فريد (باستثناء الصفحة الحالية)
        $originalSlug = $slug;
        $counter = 1;
        while (Page::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $page->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'slug' => $slug,
        ]);

        return response()->json(['success' => true, 'message' => 'تم تحديث الصفحة بنجاح!']);
    }

    // حذف صفحة
    public function destroy_pages(Page $page) {
        $page->delete();
        return response()->json(['success' => true, 'message' => 'تم حذف الصفحة بنجاح!']);
    }

     public function admin_settings() {
        return view('admin.settings');
    }
    
   
}