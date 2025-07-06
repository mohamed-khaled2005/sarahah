<?php 
use App\Models\Post;
$posts = Post::all();
?>
@extends('layouts.app')
@section('title','blog')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/posts/index.css') }}">
@endsection

@section("main")


<section id="articles" class="articles-section">
  <div class="container">
    <h2 class="section-title">آخر المقالات</h2>
      <!-- Articles Section -->
        <section class="articles-section">
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
</section>

@endsection