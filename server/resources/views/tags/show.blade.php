@extends('app')

@section('title', 'タグ別募集一覧')

@section('content')
  {{-- ヘッダー --}}
  @include('shared/header')

  <main class="main-wrapper">
    <div class="main-wrapper__inner">
      <div class="main-container">
        {{-- 投稿一覧 --}}
        <div class="post-section">
          <div class="post-section__title">
            <p>タグ「{{ $tag->name }}」の募集一覧</p>
          </div>
          {{-- 記事のカード --}}
          @foreach ($tag->posts as $post)
            @include('shared/card')
          @endforeach
        </div>
      </div>
      {{-- サイドバー --}}
      @include('shared/sidebar')
    </div>
  </main>
@endsection