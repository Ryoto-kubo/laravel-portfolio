@extends('app')

@section('title', 'メンバー募集詳細')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="post-section">
            <div class="post-section__title">
              <p style="border: none;">募集詳細</p>
            </div>
            @if (Auth::user()->id === $post->user_id)
            <div class="post-section__btn">
              <form action="{{ route('post.edit', ['post' => $post]) }}">
                <button class="edit-btn">編集</button>
              </form>
              <form method="POST" action="{{ route('post.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick='return confirm("本当に削除しますか？");'>削除</button>
              </form>
            </div>
            @endif
            <table>
              <tr>
                <th>投稿者</th>
                <td><a href="{{ route('user.show', ['user' => $post->user]) }}">{{ $post->user->name }}</a></td>
              </tr>
              <tr>
                <th>タイトル</th>
                <td>{{ $post->title }}</td>
              </tr>
              <tr>
                <th>チーム名</th>
                <td>{{ $post->team_name }}</td>
              </tr>
              <tr>
                <th>都道府県</th>
                <td>{{ $post->prefecture->name }}</td>
              </tr>
              <tr>
                <th>活動場所</th>
                <td>{!! nl2br($post->activity_place) !!}</td>
              </tr>
              <tr>
                <th>活動時間</th>
                <td>{!! nl2br($post->activity_time) !!}</td>
              </tr>
              <tr>
                <th>詳しい説明</th>
                <td>{!! nl2br(e($post->description)) !!}</td>
              </tr>
            </table>
            <div class="comment-box">
              <form action="{{ route('comment.store', ['post' => $post])}}" method="POST" class="comment-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="text" cols="30" rows="2" placeholder="コメントする"></textarea>
                <input type="submit" value="コメントする">
              </form>
              <div class="comments">
                <p class="comments__title">＜コメント一覧＞</p>
                @foreach ($comments as $comment)
                <div class="comment">
                  <p class="comment__user"><a href="{{ route('user.show', ['user' => $comment->user]) }}">{{ $comment->user->name }}</a></p>
                  <p class="comment__date">{{ $comment->created_at->format('Y/m/d H:i') }}</p>
                </div>
                <p class="comment__text">{!! nl2br(e($comment->text)) !!}</p>
                @endforeach
                </p>
              </div>
            </div>
          </div>
        </div>
        @include('shared/sidebar')
      </div>
    </main>
@endsection