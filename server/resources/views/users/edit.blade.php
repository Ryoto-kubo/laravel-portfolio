@extends('app')

@section('title', 'プロフィール編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="user-section">
            <p class="user-section__title">プロフィール編集</p>
            <form action="" method="POST">
              @csrf
              <div class="text-box">
                <label>名前</label>
                <input type="text" placeholder="名前を入力して下さい">
              </div>
              <div class="text-box">
                <label>メールアドレス</label>
                <input type="email" placeholder="メールアドレスを入力して下さい">
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
              <div class="select-box selected">
                <select>
                  <option value="" hidden>ポジションを選んでください</option>
                  <option value="1">PG</option>
                  <option value="2">SG</option>
                  <option value="3">SF</option>
                  <option value="4">PF</option>
                  <option value="5">C</option>
                </select>
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