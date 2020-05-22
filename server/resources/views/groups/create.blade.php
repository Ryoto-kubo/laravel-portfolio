@extends('app')

@section('title', 'チャットグループ作成')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="group-section new-group">
            <div class="group-section__title">
              <p>チャットグループを作成</p>
            </div>
            @include('error_card_list')
            <form action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="text-box">
                <label class="text-label">グループ名</label>
                <input name="name" type="text" placeholder="グループ名を入力して下さい">
              </div>
              <div class="file-box">
                <p>画像</p>
                <input type="file" name="image">
              </div>
              <p style="margin-bottom: 10px;">フォロー中のユーザーを追加</p>
              <select id="select" name="users[]" multiple="multiple" placeholder="追加するユーザーを選択して下さい">
                @foreach ($followings as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
              <div class="submit-box">
                <input type="submit" value="作成" class="submit-btn">
              </div>
            </form>
          </div>
        </div>
        @include('shared/sidebar')
      </div>
    </main>
@endsection