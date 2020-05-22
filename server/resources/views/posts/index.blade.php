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
          <form>
            <div class="search-box">
              <label class="text-label">フリーワードで検索</label>
              <input type="text" placeholder="検索" name="title" value="{{ $search_title }}">
              <i class="fas fa-search"></i>
            </div>
            <div class="select-box selected">
              <select name="prefecture_id">
                <option value="" hidden>都道府県を選んでください</option>
                @foreach ($prefectures as $prefecture)
                @if ($search_prefecture === $prefecture->id)
                <option selected value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                @else
                <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="submit-box">
              <input type="submit" value="検索する" class="submit-btn">
            </div>
          </form>
        </div>
        {{-- 投稿一覧 --}}
        <div class="post-section">
          <div class="post-section__title">
            <p>投稿一覧</p>
          </div>
          {{ $posts->links('pagination::default') }}
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