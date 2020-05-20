@extends('app')

@section('title', 'チャットグループ編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="group-section new-group">
            <div class="group-section__title">
              <p>チャットグループ編集</p>
            </div>
            <form action="{{ route('group.update', ['group' => $group]) }}" method="POST" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
              <div class="text-box">
                <label class="text-label">グループ名</label>
                <input name="name" type="text" placeholder="グループ名を入力して下さい" required value="{{ $group->name ?? old('name') }}">
              </div>
              <div class="file-box">
                <p>画像</p>
                <input type="file" name="image">
              </div>
              <div class="check-box">
                <h1>参加ユーザー</h1>
                @foreach ($group_users as $group_user)
                @if ($group_user->id !== Auth::user()->id)
                <input name="users[]" value="{{ $group_user->id }}" type="checkbox" checked/>
                <label>{{ $group_user->name }}</label>
                @endif
                @endforeach
              </div>
              <div class="check-box">
                <h1>ユーザーを追加</h1>
                @foreach ($diff_users as $diff_user)
                <input name="users[]" value="{{ $diff_user->id }}" type="checkbox"/>
                <label>{{ $diff_user->name }}</label>
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