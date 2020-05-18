@extends('app')

@section('title', 'プロフィール編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="user-section">
            <p class="user-section__title">プロフィール編集</p>
            <form action="{{ route('user.update', ['user' => $user]) }}" method="POST">
              @method('PATCH')
              @csrf
              <div class="text-box">
                <label>名前</label>
                <input type="text" placeholder="名前を入力して下さい" required value="{{ $user->name ?? old('name') }}">
              </div>
              <div class="text-box">
                <label>メールアドレス</label>
                <input type="email" placeholder="メールアドレスを入力して下さい" required value="{{ $user->email ?? old('email') }}">
              </div>
              <div class="file-box">
                <p>画像</p>
                <input type="file" name="image">
              </div>
              <div class="select-box selected">
                <select>
                  <option value="" hidden>都道府県を選んでください</option>
                  <option value="1">北海道</option>
                  <option value="2">東京</option>
                  <option value="3">名古屋</option>
                  <option value="4">大阪</option>
                </select>
              </div>
              <div class="check-box">
                <p>ポジション</p>
                @foreach ($checked_positions as $checked_position)
                <input name="positions[]" value="{{ $checked_position->id }}" type="checkbox" checked/>
                <label>{{ $checked_position->name }}</label>
                @endforeach
                @foreach ($unchecked_positions as $unchecked_position)
                <input name="positions[]" value="{{ $unchecked_position->id }}" type="checkbox"/>
                <label>{{ $unchecked_position->name }}</label>
                @endforeach
              </div>
              <div class="submit-box">
                <input type="submit" value="登録する" class="submit-btn">
              </div>
            </form>
          </div>
        </div>
        @include('shared/sidebar')
      </div>
    </main>
@endsection