<div class="chat-side">
  <div class="chat-side__nav">
    <p>{{ Auth::user()->name }}</p>
    <div>
      <a href="{{ route('group.create') }}" class="circle-btn circle-btn-blue"><i class="fas fa-plus"></i></a>
    </div>
  </div>
  <div class="groups">
    @foreach ($groups as $group)
    <div class="group">
      <div style="padding-top: 10px;">
        <a href="{{ route('group.show', ['group' => $group]) }}">
          <p class="group__name">{{ $group->name }}</p>
        </a>
      </div>
      <div class="group__image">
        @if ($group->image !== null)
        <img src="/storage/images/{{ $group->image }}" alt="noimage">
        @else
        <img src="/images/noimageblack.png" alt="noimage">
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>