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
 @php
    $imagePath = $post->thumbnail && file_exists(public_path('avatars/'.$post->thumbnail))
        ? asset('avatars/'.$post->thumbnail)
        : asset('images/hero-sec.jpg'); // صورة افتراضية أو الخلفية الأساسية
@endphp

<div class="hero-image" style="background:
    linear-gradient(0deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0) 25%),
    url('{{ $imagePath }}') center/cover;">

            <div class="hero-content">
              <h2 class="hero-title">{{$post->title}}</h2>
            </div>
          </div>

          <div class="article-meta">
            <p class="meta-text">{{$post->author}} - {{$post->created_at}} - {{$post->category}}</p>
          </div>
        </section>

        <!-- Article Content -->
        <article class="article">
          <div class="article-content">
            {!! $post->content !!}
          </div>
        </article>

        <!-- Author Section -->
        <section class="author-section">
          <h3 class="section-header">الكاتب</h3>

          <div class="author-card">
            <div class="author-info">
              <h4 class="author-name">{{$post->author}}</h4>
              <p class="author-bio">كاتب محتوي لدي صراحة</p>
            </div>
            <img
              src="{{ asset('images/profile.png') }}"
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
      </div>
    </main>
    @endsection

