@extends('app')

@section('title', 'メンバー募集編集')

@section('content')
    @include('shared/header')

    <main class="main-wrapper">
      <div class="main-wrapper__inner">
        <div class="main-container">
          <div class="post-section new-post">
            <div class="post-section__title">
              <p>チーム募集を編集</p>
            </div>
            @include('error_card_list')
            <form action="{{ route('post.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
              @method('PATCH')
              @include('posts/form')
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