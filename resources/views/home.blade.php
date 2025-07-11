@extends('layouts.app')
@section('title','صراحة - تلقي رسائل صادقة من أصدقائك')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
@endsection
@section('main')
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <h2 class="hero-title">صارح من تحب… وكن صادقًا بلا حواجز!</h2>
        <p class="hero-subtitle">
          أنشئ رابطك الشخصي وابدأ في تلقي رسائل صادقة من أصدقائك وزملائك بسرية
          تامة.
        </p>
        <button class="hero-btn"><a href="{{ route('register') }}">أنشيء رابطك الأن</a></button>
      </div>
    </section>

    <!-- Main Content -->
    <main class="main">
      <div class="container">
        <!-- Login Section -->
        <section class="login-section">
          <div class="content-layout">
            <!-- Right Side Content -->
            <div class="content-right">
              <h3 class="content-title">موقع صراحة</h3>
              <p class="content-description">
                إنضم إلى ملايين المستخدمين على موقع ومنصة صراحة، شارك حسابك
                وابدأ بتلقي الرسائل السرية والصراحة من الناس، سيكتب الأصدقاء وكل
                من حولك رأيهم بسرية تامة. إنطلق الآن في عالم موقع صراحة ولا تضيع
                الوقت.
              </p>
              <button class="content-btn"><a href="{{ route('register') }}">سجل وتلقي الآن الرسائل</a></button>
            </div>

           <div class="login-form-container">
  <form action="{{ route('login_user') }}" method="post" class="login-form">
    @csrf
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
  <div class="alert alert-error">
    @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>
@endif

    <!-- Email Field -->
    <div class="form-group">
      <label class="form-label">تسجيل الدخول</label>
      <div class="input-container">
        <input
          type="text"
          name="emailorusername"
          placeholder="الأيميل أو اسم المستخدم"
          class="form-input"
          value="{{ old('emailorusername') }}"
          required
        />
      </div>
      @error('emailorusername')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </div>

    <!-- Password Field -->
    <div class="form-group">
      <label class="form-label">الباسورد</label>
      <div class="input-container">
        <input
          type="password"
          name="password"
          placeholder="أدخل كلمة المرور"
          class="form-input"
          required
        />
        <button type="button" class="password-toggle">
          <!-- أيقونة هنا -->
        </button>
      </div>
      @error('password')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </div>

    <!-- Remember & Forgot -->
    <div class="form-options">
      <div class="remember-me">
        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember">تذكرني</label>
      </div>
      <a href="{{ route('reset_password') }}" class="forgot-password">نسيت كلمة المرور؟</a>
    </div>

    <!-- Login Button -->
    <button type="submit" class="google-btn login-btn">تسجيل الدخول</button>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Google Login (اختياري) -->
    <button type="button" class="google-btn">
      <!-- أيقونة -->
      تسجيل الدخول باستخدام حساب Google
    </button>

    <!-- Sign Up Link -->
    <div class="signup-link">
      <span>ليس لديك حساب؟</span>
      <a href="{{ route('register') }}">أنشاء حساب جديد</a>
    </div>
  </form>
</div>
          </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
          <h2 class="section-title">مميزات المنصة</h2>
          <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
              <div class="feature-icon">
                <svg width="19" height="21" viewBox="0 0 19 21" fill="none">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M16.7 7.5H13.7V5.25C13.7 2.76472 11.6853 0.75 9.2 0.75C6.71472 0.75 4.7 2.76472 4.7 5.25V7.5H1.7C0.87157 7.5 0.199997 8.17157 0.199997 9V19.5C0.199997 20.3284 0.87157 21 1.7 21H16.7C17.5284 21 18.2 20.3284 18.2 19.5V9C18.2 8.17157 17.5284 7.5 16.7 7.5ZM6.2 5.25C6.2 3.59315 7.54314 2.25 9.2 2.25C10.8569 2.25 12.2 3.59315 12.2 5.25V7.5H6.2V5.25ZM16.7 19.5H1.7V9H16.7V19.5ZM10.325 14.25C10.325 14.8713 9.82132 15.375 9.2 15.375C8.57868 15.375 8.075 14.8713 8.075 14.25C8.075 13.6287 8.57868 13.125 9.2 13.125C9.82132 13.125 10.325 13.6287 10.325 14.25Z"
                    fill="#0D121C"
                  />
                </svg>
              </div>
              <h3 class="feature-title">مجهول تمامًا</h3>
              <p class="feature-description">لا يتم الكشف عن هوية أي مرسل.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
              <div class="feature-icon">
                <svg width="21" height="16" viewBox="0 0 21 16" fill="none">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M19.6 0.5H1.59999C1.18578 0.5 0.849991 0.835786 0.849991 1.25V14C0.849991 14.8284 1.52156 15.5 2.34999 15.5H18.85C19.6784 15.5 20.35 14.8284 20.35 14V1.25C20.35 0.835786 20.0142 0.5 19.6 0.5ZM10.6 8.48281L3.52843 2H17.6716L10.6 8.48281ZM7.85405 8L2.34999 13.0447V2.95531L7.85405 8ZM8.96405 9.01719L10.0891 10.0531C10.3759 10.3165 10.8166 10.3165 11.1034 10.0531L12.2284 9.01719L17.6659 14H3.52843L8.96405 9.01719ZM13.3459 8L18.85 2.95437V13.0456L13.3459 8Z"
                    fill="#0D121C"
                  />
                </svg>
              </div>
              <h3 class="feature-title">رسائل غير محدودة</h3>
              <p class="feature-description">
                استقبل عددًا غير محدود من الرسائل.
              </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
              <div class="feature-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 7H16C18.7614 7 21 9.23858 21 12C21 14.7614 18.7614 17 16 17H14M10 7H8C5.23858 7 3 9.23858 3 12C3 14.7614 5.23858 17 8 17H10M8 12H16" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              </div>
              <h3 class="feature-title">رابطك الخاص</h3>
              <p class="feature-description">
                خصّص رابطك وشاركه على وسائل التواصل.
              </p>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card">
              <div class="feature-icon">
                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 251.659 251.659" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g id="Layer_57_31_"> <g> <path d="M23.869,19.622h96.471v17.341h19.609V0H4.245v203.576h92.988v-33.759H23.869V19.622z M74.961,180.278 c3.615,0,6.543,2.93,6.543,6.541c0,3.605-2.928,6.54-6.543,6.54c-3.613,0-6.541-2.93-6.541-6.54 C68.42,183.203,71.343,180.278,74.961,180.278z"></path> <path d="M111.71,48.083v203.576h135.704V48.083H111.71z M182.426,241.438c-3.61,0-6.54-2.93-6.54-6.54 c0-3.615,2.93-6.541,6.54-6.541c3.615,0,6.546,2.931,6.546,6.541C188.972,238.503,186.041,241.438,182.426,241.438z M227.787,217.901h-96.453V67.705h96.474L227.787,217.901z"></path> </g> </g> </g> </g></svg>
              </div>
              <h3 class="feature-title">متوافق مع جميع الأجهزة</h3>
              <p class="feature-description">تصميم متجاوب كليًا.</p>
            </div>

            <!-- Feature 5 -->
            <div class="feature-card">
              <div class="feature-icon">
               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 15L21 21M21 15L15 21M10 21V14.6627C10 14.4182 10 14.2959 9.97237 14.1808C9.94787 14.0787 9.90747 13.9812 9.85264 13.8917C9.7908 13.7908 9.70432 13.7043 9.53137 13.5314L3.46863 7.46863C3.29568 7.29568 3.2092 7.2092 3.14736 7.10828C3.09253 7.01881 3.05213 6.92127 3.02763 6.81923C3 6.70414 3 6.58185 3 6.33726V4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H19.4C19.9601 3 20.2401 3 20.454 3.10899C20.6422 3.20487 20.7951 3.35785 20.891 3.54601C21 3.75992 21 4.03995 21 4.6V6.33726C21 6.58185 21 6.70414 20.9724 6.81923C20.9479 6.92127 20.9075 7.01881 20.8526 7.10828C20.7908 7.2092 20.7043 7.29568 20.5314 7.46863L17 11" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              </div>
              <h3 class="feature-title">فلترة ذكية</h3>
              <p class="feature-description">
                نظام تلقائي لكشف ومنع الرسائل المسيئة.
              </p>
            </div>

            <!-- Feature 6 -->
            <div class="feature-card">
              <div class="feature-icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M18.8003 5.79625C20.9559 10.3046 19.3577 15.7129 15.0979 18.3255C10.838 20.938 5.29291 19.9107 2.25168 15.9455C-0.789558 11.9803 -0.344225 6.35844 3.28337 2.9215C6.91096 -0.515443 12.5486 -0.656918 16.3441 2.59375L18.4694 0.4675C18.7624 0.174444 19.2376 0.174444 19.5306 0.4675C19.8237 0.760556 19.8237 1.23569 19.5306 1.52875L10.5306 10.5288C10.2376 10.8218 9.76243 10.8218 9.46937 10.5288C9.17632 10.2357 9.17632 9.76056 9.46937 9.4675L12.0681 6.86875C10.6182 5.90981 8.6993 6.07307 7.4322 7.26318C6.1651 8.45328 5.88202 10.3582 6.7483 11.8653C7.61457 13.3724 9.40306 14.0866 11.0692 13.5908C12.7353 13.0949 13.8422 11.519 13.7434 9.78344C13.7201 9.36922 14.037 9.01455 14.4513 8.99125C14.8655 8.96795 15.2201 9.28485 15.2434 9.69906C15.3843 12.1572 13.798 14.383 11.4284 15.0519C9.0589 15.7209 6.5428 14.6533 5.37739 12.4844C4.21198 10.3155 4.71038 7.62811 6.576 6.02137C8.44163 4.41462 11.1732 4.32024 13.1453 5.79437L15.2781 3.66156C12.0414 0.974274 7.30002 1.15714 4.27992 4.08575C1.25983 7.01435 0.931232 11.7479 3.51771 15.0657C6.10419 18.3835 10.7749 19.2198 14.3518 17.0055C17.9288 14.7912 19.2629 10.2377 17.4466 6.44312C17.2679 6.0693 17.4262 5.62144 17.8 5.44281C18.1738 5.26418 18.6217 5.42242 18.8003 5.79625Z"
                    fill="#0D121C"
                  />
                </svg>
              </div>
              <h3 class="feature-title">تجربة سهلة وسريعة</h3>
              <p class="feature-description">تسجيل بدون تعقيدات.</p>
            </div>
          </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
          <h2 class="section-title-small">كيف تعمل المنصة</h2>
          <div class="steps">
            <!-- Step 1 -->
            <div class="step">
              <div class="step-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 18L14 18M17 15V21M4 21C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                <div class="step-line"></div>
              </div>
              <div class="step-content">
                <h3 class="step-title">سجّل حسابك</h3>
                <p class="step-description">
                  انشئ حسابًا خاصًا بك لتلقي الرسائل.
                </p>
              </div>
            </div>

            <!-- Step 2 -->
            <div class="step">
              <div class="step-icon">
                <div class="step-line-top"></div>
                <svg width="20" height="17" viewBox="0 0 20 17" fill="none">
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M19.5306 6.28063L15.0306 10.7806C14.7376 11.0737 14.2624 11.0737 13.9694 10.7806C13.6763 10.4876 13.6763 10.0124 13.9694 9.71937L17.1897 6.5H13.4688C9.70591 6.49896 6.41915 9.04415 5.47844 12.6875C5.37488 13.0888 4.96564 13.3301 4.56437 13.2266C4.16311 13.123 3.92176 12.7138 4.02531 12.3125C5.13533 8.00544 9.02096 4.99662 13.4688 5H17.1916L13.9694 1.78062C13.6763 1.48757 13.6763 1.01243 13.9694 0.719375C14.2624 0.426319 14.7376 0.426319 15.0306 0.719375L19.5306 5.21937C19.6715 5.36005 19.7506 5.55094 19.7506 5.75C19.7506 5.94906 19.6715 6.13995 19.5306 6.28063Z"
                    fill="#0D121C"
                  />
                </svg>
                <div class="step-line"></div>
              </div>
              <div class="step-content">
                <h3 class="step-title">شارك رابطك</h3>
                <p class="step-description">
                  انسخ رابطًا مميّزًا وشاركه مع أصدقائك وزملائك.
                </p>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="step">
              <div class="step-icon">
                <div class="step-line-top"></div>
               <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 2L12 10M12 10L15 7M12 10L9 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 13H5.16026C6.06543 13 6.51802 13 6.91584 13.183C7.31367 13.3659 7.60821 13.7096 8.19729 14.3968L8.80271 15.1032C9.39179 15.7904 9.68633 16.1341 10.0842 16.317C10.482 16.5 10.9346 16.5 11.8397 16.5H12.1603C13.0654 16.5 13.518 16.5 13.9158 16.317C14.3137 16.1341 14.6082 15.7904 15.1973 15.1032L15.8027 14.3968C16.3918 13.7096 16.6863 13.3659 17.0842 13.183C17.482 13 17.9346 13 18.8397 13H22" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path d="M22 12.0001C22 16.7141 22 19.0712 20.5355 20.5356C19.0711 22.0001 16.714 22.0001 12 22.0001C7.28595 22.0001 4.92893 22.0001 3.46447 20.5356C2 19.0712 2 16.7141 2 12.0001C2 7.28604 2 4.92902 3.46447 3.46455C4.28094 2.64808 5.37486 2.28681 7 2.12695M17 2.12695C18.6251 2.28681 19.7191 2.64808 20.5355 3.46455C21.5093 4.43829 21.8356 5.80655 21.9449 8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
              </div>
              <div class="step-content">
                <h3 class="step-title">استقبل الرسائل بسريع</h3>
                <p class="step-description">
                  استقبل رسائل صادقة بسريعة تامة واستمتع بآراء الآخرين.
                </p>
              </div>
            </div>
          </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
          <h2 class="section-title-large">الأسئلة الشائعة</h2>
          <div class="faq-container">
  <details open>
    <summary>كيف يعمل موقع "صراحة"؟</summary>
    <p>
      ببساطة، تقوم بإنشاء حساب والحصول على رابط خاص بك. بعد ذلك تشارك الرابط مع أصدقائك أو متابعينك ليستطيعوا إرسال رسائل مجهولة لك دون معرفة هويتهم. يمكنك قراءة هذه الرسائل من لوحة التحكم الخاصة بك.
    </p>
  </details>

  <details>
    <summary>هل يمكن لأي شخص أن يعرف من أرسل الرسالة؟</summary>
    <p>
      لا، جميع الرسائل تبقى مجهولة المصدر تماماً، ولا يمكن للمستلم معرفة هوية المرسل.
    </p>
  </details>

  <details>
    <summary>هل الموقع آمن؟</summary>
    <p>
      نعم، يتم تأمين بيانات المستخدمين وعدم مشاركة أي معلومات حساسة. لكن يُفضل عدم مشاركة بيانات شخصية حساسة في الرسائل.
    </p>
  </details>

  <details>
    <summary>هل يمكنني الرد على الرسائل؟</summary>
    <p>
      لا يمكن الرد مباشرة على المرسل لأنه مجهول، لكن يمكنك نشر الرسالة مع رد علني في صفحتك الشخصية.
    </p>
  </details>

  <details>
    <summary>ماذا أفعل إذا وصلتني رسالة مسيئة؟</summary>
    <p>
      يمكنك الإبلاغ عن الرسالة من خلال زر "إبلاغ" ليتم مراجعتها من قبل فريق الإشراف، كما يمكنك تجاهلها تماماً.
    </p>
  </details>
</div>

        </section>
        <!-- Articles Section -->
        <section class="articles-section">
          <h2 class="section-title-large">أحدث المقالات</h2>
          <div class="articles-grid">
      @foreach($posts as $post)
      <article class="article-card">
        <a href="{{url('/blog/'.$post->slug)}}">
          <img class="card-image" src="{{url('avatars/'.$post->thumbnail)}}">
          <div class="card-content">
            <h3 class="card-title">{{$post->title}}</h3>
            <p class="card-description">{{ Str::words($post->content, 18, '...') }}</p>
          </div>
        </a>
      </article>
    @endforeach
          </div>
        </section>
      </div>
    </main>
  <script src="{{url('js/main.js')}}">
    </script>
@endsection