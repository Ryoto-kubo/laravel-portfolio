@extends('app')

@section('title', 'チャット画面')

@section('content')
<div class="wrapper">
  @include('shared/header')
  <div class="chat-wrapper">
    @include('shared/chat_side')
    
    <div class="chat-main">
      <div class="chat-header">
        <div class="chat-header__left">
          <p class="group-name">{{ $group->name }}</p>
          <p class="group-member">
            メンバー：
          @foreach($group->users->sortBy('id') as $user)
          <a href="{{ route('user.show', ['user' => $user]) }}">{{ $user->name }}</a>
          @endforeach
          </p>
          </div>
        <div class="chat-header__right">
          <a href="{{ route('group.edit', ['group' => $group]) }}" class="edit-btn">編集</a>
        </div>
      </div>
      <div class="chat-messages">
        @foreach ($messages as $message)
        <div class="message">
          <div class="message__info">
            <p class="user-name">{{ $message->user->name }}</p>
            <p class="send-time">{{ $message->created_at->format('Y/m/d H:i') }}</p>
          </div>
          <div class="message__desc">{{ $message->text }}</div>
        </div>
        @endforeach
      </div>
      <div class="chat-form-box">

        <form action="{{ route('message.store', ['group' => $group]) }}" method="POST" class="chat-form">
          @csrf
          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          <input type="hidden" name="group_id" value="{{ $group->id }}">
          <input type="text" name="text" class="chat-message" placeholder="メッセージを入力して下さい">
          <input type="submit" value="送信する" class="chat-submit">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection