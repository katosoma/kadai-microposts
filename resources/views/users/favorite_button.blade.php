@if (Auth::check())
    @if (Auth::user()->is_adding_to_favorites($micropost->id))
        {{-- お気に入り解除ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-green-700 btn-sm normal-case w-1/8 h-1" 
                onclick="return confirm('id = {{ $micropost->id }} のお気に入りを外します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- お気に入り登録ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-outline btn-sm normal-case w-1/8 h-1">Favorite</button>
        </form>
    @endif
@endif