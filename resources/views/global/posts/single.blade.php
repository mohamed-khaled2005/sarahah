@extends('layouts.app')
@section('title','عنوان المقال')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/posts/single.css') }}">
@endsection

   @section("main")
    <!-- Main Content -->
    <main class="main">
      <div class="container">
        <!-- Hero Section -->
        <section class="hero">
          <div class="hero-image">
            <div class="hero-content">
              <h2 class="hero-title">عنوان المقال</h2>
            </div>
          </div>

          <div class="article-meta">
            <p class="meta-text">الكاتب، تاريخ النشر، تصنيف المقال</p>
          </div>
        </section>

        <!-- Article Content -->
        <article class="article">
          <div class="article-content">
            <h3 class="article-title">
              التسويق بالعمولة: دخل إضافي عبر الإنترنت
            </h3>

            <p class="article-paragraph">
              التسويق بالعمولة (Affiliate Marketing) هو أحد أشهر طرق كسب المال
              عبر الإنترنت، حيث يقوم المسوقون بالترويج لمنتجات أو خدمات شركات
              أخرى مقابل عمولة مالية عند تحقيق عملية بيع أو إحالة ناجحة.
            </p>

            <div class="article-section">
              <h4 class="section-title">كيف يعمل؟</h4>
              <ul class="article-list">
                <li>
                  الانضمام لبرنامج تسويق بالعمولة مثل (Amazon Associates,
                  ShareASale, أو برامج محلية).
                </li>
                <li>اختيار منتجات مناسبة للجمهور المستهدف.</li>
                <li>
                  الترويج عبر منصات مختلفة مثل المدونات، مواقع التواصل
                  الاجتماعي، أو الإعلانات المدفوعة.
                </li>
                <li>جني الأرباح عند تحقيق مبيعات من الروابط الخاصة بك.</li>
              </ul>
            </div>

            <div class="article-section">
              <h4 class="section-title">مميزاته</h4>
              <ul class="article-list">
                <li>لا يحتاج إلى رأس مال كبير.</li>
                <li>مرونة في العمل من أي مكان.</li>
                <li>دخل سلبي بعد بناء قاعدة جماهيرية.</li>
              </ul>
            </div>

            <div class="article-section">
              <h4 class="section-title">تحدياته</h4>
              <ul class="article-list">
                <li>يحتاج إلى صبر واستمرارية لتحقيق النجاح.</li>
                <li>المنافسة الشديدة في بعض المجالات.</li>
              </ul>
            </div>

            <p class="article-paragraph">
              باختصار، يُعد التسويق بالعمولة فرصة رائعة لتحقيق دخل إضافي أو حتى
              بدء عمل كامل عبر الإنترنت، شرط الالتزام والتعلم المستمر.
            </p>
          </div>
        </article>

        <!-- Author Section -->
        <section class="author-section">
          <h3 class="section-header">الكاتب</h3>

          <div class="author-card">
            <div class="author-info">
              <h4 class="author-name">الكاتب</h4>
              <p class="author-bio">كاتب ومهتم بمحتوى التعبير الذاتي</p>
            </div>
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/1726c7fdc93259e2e33f66b06905a1b2499efd0d"
              alt="Author"
              class="author-avatar"
            />
          </div>
        </section>

        <!-- Related Articles -->
        <section class="related-articles">
          <h3 class="section-header">مقالات ذات صلة</h3>

          <div class="articles-grid">
            <div class="article-card">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/1804807228d045db203d1e609cb4e5374fda63ed"
                alt="Article 1"
                class="article-image"
              />
              <div class="card-content">
                <h4 class="card-title">عنوان المقال الأول</h4>
              </div>
            </div>

            <div class="article-card">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/755b41ff53807eb61909972d8a68fda16f642925"
                alt="Article 2"
                class="article-image"
              />
              <div class="card-content">
                <h4 class="card-title">عنوان المقال الثاني</h4>
              </div>
            </div>

            <div class="article-card">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/f5fbef9631136f46ba38301f34a1328988682cab"
                alt="Article 3"
                class="article-image"
              />
              <div class="card-content">
                <h4 class="card-title">عنوان المقال الثالث</h4>
              </div>
            </div>

            <div class="article-card">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/f5fbef9631136f46ba38301f34a1328988682cab"
                alt="Article 4"
                class="article-image"
              />
              <div class="card-content">
                <h4 class="card-title">عنوان المقال الثالث</h4>
              </div>
            </div>
          </div>
        </section>

        <!-- Comments Section -->
        <section class="comments-section">
          <h3 class="section-header">التعليقات</h3>

          <!-- Comment Form -->
          <div class="comment-form clearfix">
            <textarea
              class="comment-textarea"
              placeholder="اكتب تعليقك هنا..."
            ></textarea>
            <button class="submit-btn">إرسال</button>
          </div>

          <!-- Comments List -->
          <div class="comments-list">
            <div class="comment">
              <div class="comment-content">
                <div class="comment-header">
                  <span class="comment-time">2 يوم</span>
                  <span class="comment-author">Aisha</span>
                </div>
                <p class="comment-text">تعليق المستخدم</p>
              </div>
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/ee0c4304a13e69f8946e9465630a64ad3262e63a"
                alt="User"
                class="comment-avatar"
              />
            </div>

            <div class="comment">
              <div class="comment-content">
                <div class="comment-header">
                  <span class="comment-time">3 أيام</span>
                  <span class="comment-author">Omar</span>
                </div>
                <p class="comment-text">تعليق آخر</p>
              </div>
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/1f8da5ab2094a10dfb1215b0f0fe6be2361d4a10"
                alt="User"
                class="comment-avatar"
              />
            </div>
          </div>
        </section>
      </div>
    </main>
    @endsection

