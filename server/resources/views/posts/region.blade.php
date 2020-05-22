@extends('app')

@section('title', 'エリア別募集一覧')

@section('content')
  {{-- ヘッダー --}}
  @include('shared/header')

  <main class="main-wrapper">
    <div class="main-wrapper__inner">
      <div class="main-container">
        {{-- 投稿一覧 --}}
        <div class="post-section">
          <div class="post-section__title">
            <p>「{{ $region->name }}地方」の募集一覧</p>
          </div>
          {{-- 記事のカード --}}
          @foreach ($posts as $post)
            @if ($post->prefecture->region->name === $region->name)
            @include('shared/card')
            @endif
          @endforeach
        </div>
      </div>
      {{-- サイドバー --}}
      @include('shared/sidebar')
    </div>
  </main>
@endsection