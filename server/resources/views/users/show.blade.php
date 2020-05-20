@extends('app')

@section('title', 'マイページ')

@section('content')
  {{-- ヘッダー --}}
  @include('shared/header')

  <main class="main-wrapper">
    <div class="main-wrapper__inner">
      <div class="main-container">
        {{-- ユーザー情報 --}}
        <div class="user-section">
          <div class="user-section__top">
            <div class="user-section__top--left">
              <div class="user-image">
                @if ($user->image !== null)
                <img src="/storage/images/{{ $user->image }}" alt="noimage">
                @else
                <img src="/images/noimageblack.png" alt="noimage">
                @endif
              </div>
              <p>{{ $user->name }}</p>
            </div>
            {{-- フォローボタン --}}
            @if( Auth::id() !== $user->id )
            <follow-button
            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
            :authorized='@json(Auth::check())'
            end-point="{{ route('user.follow', ['user' => $user]) }}"
            >
            </follow-button>
            @endif
          </div>
          <div class="user-section__bottom">
            @if ( isset($age) )
              <p class="user-age">
                年齢：{{ $age }}歳
              </p>
            @else
              <p class="user-age">
                年齢：設定されていません
              </p>
            @endif

            @if (!empty($user->prefecture))
              <p class="user-prefecture">
                都道府県：{{ $user->prefecture->name }}
              </p>
            @else
              <p class="user-prefecture">
                都道府県：設定されていません
              </p>
            @endif

            @foreach ($positions as $position)
              @if ($loop->first)
              <p class="user-position">
                ポジション：
              @endif
              @if (!empty($position))
                <span>
                  {{ $position->name }}
                  @if (!$loop->last)
                  /
                  @endif
                </span>
              @endif
              @if ($loop->last)
              </p> 
              @endif
            @endforeach
            <p class="user-follow">フォロー：<a href="{{ route('user.followings', ['user' => $user]) }}">{{ $user->count_followings }}</a></p>
            <p class="user-follower">フォロワー：<a href="{{ route('user.followers', ['user' => $user]) }}">{{ $user->count_followers }}</a></p>
          </div>
        </div>
        <div class="post-section">
          <div class="post-section__title">
            <p>{{ $user->name }}の投稿一覧</p>
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