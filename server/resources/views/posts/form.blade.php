@csrf
<div class="text-box">
  <label class="text-label">タイトル</label>
  <input name="title" type="text" placeholder="タイトルを入力して下さい" required value="{{ $post->title ?? old('title') }}">
</div>
<div class="text-box">
  <label class="text-label">チーム名</label>
  <input name="team_name" type="text" placeholder="チーム名を入力して下さい" required value="{{ $post->team_name ?? old('team_name') }}">
</div>
<div class="file-box">
  <p>画像</p>
  <input type="file" name="image">
</div>
@if ($post ?? '')
<div class="select-box selected">
  <select name="prefecture_id">
    <option value="" hidden>都道府県を選んでください</option>
    @foreach ($prefectures as $prefecture)
    @if ($prefecture->id === $post->prefecture_id)
    <option value="{{ $prefecture->id }}" selected>{{ $prefecture->name }}</option>
    @else
    <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
    @endif
    @endforeach
  </select>
</div>
@else
<div class="select-box selected">
  <select name="prefecture_id">
    <option value="" hidden>都道府県を選んでください</option>
    @foreach ($prefectures as $prefecture)
    <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
    @endforeach
  </select>
</div>
@endif
<div class="text-box">
  <label class="text-label">活動場所</label>
  <textarea name="activity_place" placeholder="活動場所を入力して下さい" rows="1">{{ $post->activity_place ?? old('activity_place') }}</textarea>
</div>
<div class="text-box">
  <label class="text-label">活動時間</label>
  <textarea name="activity_time" type="text" placeholder="活動時間を入力して下さい" rows="1">{{ $post->activity_time ?? old('activity_time') }}</textarea>
</div>
<div class="text-box">
  <p>詳しい説明</p>
  <textarea name="description" cols="20" rows="10" placeholder="詳しい説明を入力してください">{{ $post->description ?? old('description') }}</textarea>
</div>
<post-tags-input
  :initial-tags='@json($tag_names ?? [])'
  :autocomplete-items='@json($all_tag_names ?? [])'
>
</post-tags-input>
