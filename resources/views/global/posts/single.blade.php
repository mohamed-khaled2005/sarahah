
<?php 
use App\Models\Post;
$posts = Post::all();
?>
@extends('layouts.app')
@section('title')
{{$post->title}}
@endsection
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

        <!-- Articles Section -->
        <section class="articles-section">
          <h2 class="section-title-large">مقالات ذات صلة</h2>
          <div class="articles-grid">
      @foreach($posts as $rel_post)
      <article class="article-card">
        <a href="{{url('/blog/'.$rel_post->slug)}}">
          <img class="card-image" src="{{url('avatars/'.$rel_post->thumbnail)}}">
          <div class="card-content">
            <h3 class="card-title">{{$rel_post->title}}</h3>
            <p class="card-description">{{ Str::words($rel_post->content, 18, '...') }}</p>
          </div>
        </a>
      </article>
    @endforeach
          </div>
        </section>


      </div>
    </main>
    @endsection

