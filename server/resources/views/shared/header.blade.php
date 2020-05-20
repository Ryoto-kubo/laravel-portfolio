<header class="header">
  <div class="header__inner">
    <div class="header__left-box">
      <p class="main-title">
        <a href="{{ route('home') }}">Basket Ball</a>
      </p>
    </div>
    <ul class="header__right-box">
      @guest
        <li><a href="{{ route('register') }}">新規登録</a></li>
        <li><a href="{{ route('login') }}">ログイン</a></li>
      @endguest
      @auth
        <li><a href="{{ route('user.show', ['user' => Auth::id()]) }}">{{ Auth::user()->name }}</a></li>
        <li><a href="{{ route('user.edit', ['user' => Auth::id()]) }}">プロフィール編集</a></li>
        <li>
          <form name="logout" id="logout-button" method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="javascript:logout.submit()">ログアウト</a>
          </form>
        </li>
      @endauth
    </ul>
  </div>
</header>