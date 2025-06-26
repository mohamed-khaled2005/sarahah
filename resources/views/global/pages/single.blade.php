@extends('layouts.app')
@section('title','single page')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/single_page.css') }}">
@endsection

   @section("main")
<section id="single" class="single">
  <div class="page-container">
    <div class="content-wrapper">
      <h1 class="main-title">سياسة الخصوصية</h1>
      <article class="single-article">
        <h2 class="article-title">مقدمة</h2>
        <p class="article-text">مرحبًا بكم في تطبيق صراحة! تشرح سياسة الخصوصية هذه كيفية جمعنا للمعلومات واستخدامها وحمايتها عند استخدامك لتطبيقنا. باستخدامك لصراحة، فأنت توافق على الشروط الموضحة في هذه السياسة. نحن ملتزمون بحماية خصوصياتكم وتوفير تجربة آمنة.</p>
      </article>
      <article class="single-article">
        <h2 class="article-title">المعلومات التي لا نجمعها</h2>
        <p class="article-text">نحن لا نجمع أي معلومات شخصية ما لم تقم بتقديمها بشكل مباشر من خلال استخدامك لتطبيقنا. لا نطلب منك تقديم اسمك أو بريدك الإلكتروني أو أي معلومات شخصية أخرى لاستخدام التطبيق.</p>
      </article>
      <article class="single-article">
        <h2 class="article-title">المعلومات التي قد نقوم بجمعها</h2>
        <p class="article-text">قد نجمع معلومات غير شخصية مثل المعلومات الإحصائية الخاصة بالجهاز المستخدم والمعلومات الإحصائية التي تساعدنا على تحسين خدماتنا وتجربتك كمستخدم.</p>
      </article>
      <article class="single-article">
        <h2 class="article-title">كيف نستخدم المعلومات؟</h2>
        <p class="article-text">نستخدم المعلومات التي قد نجمعها لتحسين خدماتنا وتوفير تجربة أفضل</p>
      </article>
    </div>
  </div>
</section>
@endsection