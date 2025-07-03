@extends('layouts.app')
@section('title','single page')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/single_page.css') }}">
@endsection

   @section("main")
<section id="single" class="single">
  <div class="page-container">
    <div class="content-wrapper">
      <h1 class="main-title">{{$page->title}}</h1>
      <article class="single-article">
        {{$page->content}}
      </article>
    </div>
  </div>
</section>
@endsection