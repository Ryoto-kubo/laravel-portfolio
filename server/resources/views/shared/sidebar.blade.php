<aside class="side-bar">
  <ul class="btn-group">
    <li>
      <a href="{{ route('post.create') }}" class="big-btn orange">メンバーを募集する<span><i class="fas fa-arrow-circle-right fa-fw"></i></span></a>
    </li>
    <li>
      <a href="{{ route('post.index') }}" class="big-btn blue">チームを探す<span><i class="fas fa-arrow-circle-right fa-fw"></i></span></a>
    </li>
    <li>
      <a href="{{ route('group.index') }}" class="big-btn purple">チャット<span><i class="fas fa-arrow-circle-right fa-fw"></i></span></a>
    </li>
  </ul>
  
  <div class="region-title">
    <p>エリアから探す</p>
  </div>
  <div class="region-group">
    <ul>
      <li><a href="{{ route('region.show', ['name' => '北海道']) }}">北海道</a></li>
      <li><a href="{{ route('region.show', ['name' => '東北']) }}">東北</a></li>
      <li><a href="{{ route('region.show', ['name' => '関東']) }}">関東</a></li>
      <li><a href="{{ route('region.show', ['name' => '中部']) }}">中部</a></li>
    </ul>
    <ul>
      <li><a href="{{ route('region.show', ['name' => '近畿']) }}">近畿</a></li>
      <li><a href="{{ route('region.show', ['name' => '中国']) }}">中国</a></li>
      <li><a href="{{ route('region.show', ['name' => '四国']) }}">四国</a></li>
      <li><a href="{{ route('region.show', ['name' => '九州']) }}">九州</a></li>
    </ul>
  </div>
</aside>