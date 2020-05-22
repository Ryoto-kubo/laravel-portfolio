<div class="blog-card">
  <div class="meta">
    @if ($post->image !== null)
    <img src="/storage/images/{{ $post->image }}" class="photo">
    @else
    <img src="/images/basket6.jpeg" class="photo">
    @endif
    <ul class="details">
      <li class="author">ユーザー：<a href="{{ route('user.show', ['user' => $post->user_id]) }}">{{ $post->user->name }}</a></li>
      <li class="prefecture">都道府県：<a href="{{ route('post.index', ['prefecture_id' => $post->prefecture_id]) }}">{{ $post->prefecture->name }}</a></li>
      <li class="tags">
        <ul>
          タグ：
          @foreach ($post->tags as $tag)
          <li><a href="{{ route('tag.show', ['name' => $tag->name]) }}">{{ $tag->name }}</a></li>
          @endforeach
        </ul>
      </>
      <li class="date">投稿日時：{{ $post->created_at->format('Y/m/d H:i') }}</li>
    </ul>
  </div>
  <div class="description">
    <h1>{{ $post->title }}</h1>
    <p>{!! nl2br(e($post->description)) !!}</p>
    <p class="read-more">
      <a href="{{ route('post.show', ['post' => $post]) }}">詳しく見る</a>
    </p>
  </div>
</div>