@extends('app')

@section('title', 'ログイン')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="post-section new-post">
            <div class="post-section__title">
              <p>ログイン</p>
            </div>
            @include('error_card_list')
            <form method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="text-box">
                    <label for="email" class="text-label">メールアドレス</label>
    
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="text-box">
                    <label for="password" class="text-label">パスワード</label>

                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="text-box">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                            <label class="form-check-label" for="remember">
                                ログイン状態を保存する
                            </label>
                        </div>
                    </div>
                </div>
            
                <div class="submit-box">
                    <input type="submit" value="ログインする" class="submit-btn">
                </div>
            </form>
          </div>
        </div>
        @include('shared/sidebar')
      </div>
    </main>
@endsection
