<div class="sm:col-span-2 mt-4">
            <div class="mt-4">
                {{-- お気に入り一覧 --}}
                @if (count($favorites) > 0)
                    <ul class="list-none">
                        @foreach ($favorites as $favorite)
                            <li class="flex items-start gap-x-2 mb-4">
                                {{-- お気に入りの所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img src="{{ Gravatar::get($favorite->user->email) }}" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        {{-- お気に入りの所有者のユーザ詳細ページへのリンク --}}
                                        <a class="link link-hover text-info" href="{{ route('users.show', $favorite->user->id) }}">{{ $favorite->user->name }}</a>
                                        <span class="text-muted text-gray-500">posted at {{ $favorite->created_at }}</span>
                                    </div>
                                    <div>
                                        {{-- お気に入りの内容 --}}
                                        <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                                    </div>
                                    <div>
                                        {{--お気に入りボタン--}}
                                        @if (Auth::check())
                                            @if (Auth::user()->is_adding_to_favorites($favorite->id))
                                                {{-- お気に入り解除ボタンのフォーム --}}
                                                <form method="POST" action="{{ route('favorites.unfavorite', $favorite->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn bg-green-700 btn-sm normal-case w-1/8 h-1" 
                                                        onclick="return confirm('id = {{ $favorite->id }} のお気に入りを外します。よろしいですか？')">Unfavorite</button>
                                                </form>
                                            @else
                                                {{-- お気に入り登録ボタンのフォーム --}}
                                                <form method="POST" action="{{ route('favorites.favorite', $favorite->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline btn-sm normal-case w-1/8 h-1">Favorite</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                    <div>
                                        @if (Auth::id() == $favorite->user_id)
                                            {{-- 投稿削除ボタンのフォーム --}}
                                            <form method="POST" action="{{ route('microposts.destroy', $favorite->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error btn-sm normal-case" 
                                                    onclick="return confirm('Delete id = {{ $favorite->id }} ?')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{-- ページネーションのリンク --}}
                    {{ $favorites->links() }}
                @else
                    <p>お気に入りはありません。</p>
                @endif
            </div>
        </div>