@extends('app')

@section('title', 'プロフィール編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="user-section">
            <p class="user-section__title">プロフィール編集</p>
            <form action="{{ route('user.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
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
              <div class="text-box">
                <label>生年月日</label>
                <div class="date-box">
                  <input type="date" name="birthday" value="{{ $user->birthday ?? old('birthday') }}">
                </div>
              </div>
              <div class="file-box">
                <p>画像</p>
                <input type="file" name="image">
              </div>
              <div class="select-box selected">
                <select name="prefecture_id">
                  <option value="" hidden>都道府県を選んでください</option>
                  @foreach ($prefectures as $prefecture)
                  @if ($prefecture->id === $user->prefecture_id)
                  <option value="{{ $prefecture->id }}" selected>{{ $prefecture->name }}</option>
                  @else
                  <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="check-box">
                <p>ポジション</p>
                @foreach ($sorted_positions as $position)
                @if (empty($position->pivot))
                <input name="positions[]" value="{{ $position->id }}" type="checkbox"/>
                <label>{{ $position->name }}</label>
                @else
                <input name="positions[]" value="{{ $position->id }}" type="checkbox" checked/>
                <label>{{ $position->name }}</label>
                @endif
                @endforeach
              </div>
              <div class="submit-box">
                <input type="submit" value="更新する" class="submit-btn">
              </div>
            </form>
          </div>
        </div>
        @include('shared/sidebar')
      </div>
    </main>
@endsection