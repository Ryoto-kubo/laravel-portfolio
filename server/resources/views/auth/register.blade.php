@extends('app')

@section('title', 'ユーザー登録')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="post-section new-post">
            <div class="post-section__title">
              <p>ユーザー登録</p>
            </div>
            @include('error_card_list')
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="text-box">
                    <label for="name" class="text-label">ニックネーム</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="text-box">
                    <label for="email" class="text-label">メールアドレス</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="text-box">
                    <label for="password" class="text-label">パスワード</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="text-box">
                    <label for="password-confirm" class="text-label">パスワード(確認用)</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>
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
