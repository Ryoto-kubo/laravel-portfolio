@extends('app')

@section('title', 'チャットグループ編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="group-section new-group">
            <div class="group-section__title">
              <p>「{{ $group->name }}」を編集</p>
            </div>
            @include('error_card_list')
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
              <div class="text-box">
                <p style="margin-bottom: 10px;">フォロー中のユーザーを追加</p>
                <select id="select" name="users[]" multiple="multiple" placeholder="追加するユーザーを選択して下さい">
                  @foreach ($group_users as $group_user)
                  @if ($group_user->id !== Auth::user()->id)
                  <option value="{{ $group_user->id }}" selected>{{ $group_user->name }}</option>
                  @endif
                  @endforeach
                  @foreach ($diff_users as $diff_user)
                  <option value="{{ $diff_user->id }}">{{ $diff_user->name }}</option>
                  @endforeach
                </select>              
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