@extends('app')

@section('title', '投稿一覧')

@section('content')
  {{-- ヘッダー --}}
  @include('shared/header')

  <main class="main-wrapper">
    <div class="main-wrapper__inner">
      <div class="main-container">
        {{-- 絞り込み --}}
        <div class="narrow-down">
          <p>絞り込み</p>
          <form method="GET" action="">
            <div class="search-box">
              <label class="text-label">フリーワードで検索</label>
              <input type="text" placeholder="検索">
              <i class="fas fa-search"></i>
            </div>
            <div class="select-box selected">
              <select>
                <option value="" hidden>都道府県を選んでください</option>
                @foreach ($prefectures as $prefecture)
                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                @endforeach
              </select>
            </div>
          </form>
          <div class="sort">
            <ul>
              <li>並び順：</li>
              <li><a href="#">新着順</a></li>
              <li><a href="#">古い順</a></li>
            </ul>
          </div>
        </div>
        {{-- 投稿一覧 --}}
        <div class="post-section">
          <div class="post-section__title">
            <p>投稿一覧</p>
          </div>
          {{-- 記事のカード --}}
          @foreach ($posts as $post)
            @include('shared/card')
          @endforeach
        </div>
      </div>
      {{-- サイドバー --}}
      @include('shared/sidebar')
    </div>
  </main>
@endsection