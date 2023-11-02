<x-layout>
    <x-slot name="title">
        createComment
    </x-slot>
{{-- <?php
dd($comments);
?> --}}
    <div class="contents">
        {{-- <details>
            <summary>
                コメント新規投稿
            </summary>
            <div class="openForm">
                <form method="POST" action="{{ route('storeComment', $tweet) }}">
                    @csrf
                    <textarea name="body" id="text" onkeyup="ShowLength(value);" required maxlength="200">{{ old('body') }}</textarea>
                    <p class="length">
                        <span id="inputlength">0</span><span>/200文字</span>
                    </p>
                    <input type="hidden" name="id" value="{{ $tweet->id }}">
                    @error('body')
                    <div>{{ $message }}</div>
                    @enderror
                    <button>投稿</button>
                </form>
            </div>
        </details> --}}


        <div class="post">
                <div class="profileIcon">
                    <figure class="iconCircleSmall">
                        @if ($tweet->user_id === Auth::id())
                        <a href="{{ route('myPage') }}">
                        @else
                        <a href="{{ route('userPage', $tweet->user) }}">
                        @endif
                            @if ($tweet->user->image === null)
                            <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                            @else
                            <img class="iconImage" src="{{ asset('storage/images/'.$tweet->user->image) }}" alt="">
                            @endif
                    </figure>
                            <span class="block name">{{ $tweet->user->name }}</span>
                        </a>
                </div>
                <div class="body">
                    {!! nl2br($tweet->body_link) !!}
                </div>
                <div class="textRight day">
                    {{ $tweet->updated_at }}
                </div>
                <div class="flex">
                    @if ($tweet->user_id === Auth::id())
                        <a class="editGood" href="{{ route('edit', $tweet) }}">
                            <i class="fa-solid fa-eraser"></i>
                            <button class="btnNone">編集</button>
                        </a>
                    @else
                        <form action="{{ route('likeChange', $tweet, ) }}" method="post" class="editGood">
                            @csrf
                            @if($tweet->isLike(Auth::id()))
                            <button type="submit" class="btnNone">
                                <i class="fa-solid fa-heart fa-lg" style="color: #963649;"></i>
                            </button>
                            {{ $tweet->likes_count }}
                            @else
                            <button type="submit" class="btnNone">
                                <i class="fa-regular fa-heart fa-lg" style="color: #963649;"></i>
                            </button>
                            {{ $tweet->likes_count }}
                            @endif
                        </form>
                    @endif
                </div>
        </div>

        <p>コメント一覧</p>
        <div class="comment">
            {{-- コメントフォーム --}}
            <div class="flex post commentFormColor">
                <details>
                    <summary>
                        <i class="fa-solid fa-comment fa-flip-horizontal fa-xl rightMar5" style="color: #ccc0af;"></i>コメント新規投稿
                    </summary>
                    <div class="openForm">
                        <form method="POST" action="{{ route('storeComment', $tweet) }}">
                            @csrf
                            <textarea name="body" id="text" onkeyup="ShowLength(value);" required maxlength="200">{{ old('body') }}</textarea>
                            <p class="length">
                                <span id="inputlength">0</span><span>/200文字</span>
                            </p>
                            <input type="hidden" name="id" value="{{ $tweet->id }}">
                            @error('body')
                            <div>{{ $message }}</div>
                            @enderror
                            <button>投稿</button>
                        </form>
                    </div>
                </details>
            </div>
            {{-- コメントフォームここまで --}}
            @if ($comments == "[]")
                <div class="commentPost">
                    <p>まだコメントはありません。</p>
                </div>
            @else
                @foreach ($comments as $comment)
                    <div class="post">
                        <li>
                            <div class="profileIcon">
                                <figure class="iconCircleSmall">
                                    @if ($comment->user_id === Auth::id())
                                    <a href="{{ route('myPage') }}">
                                    @else
                                    <a href="{{ route('userPage', $comment->user) }}">
                                    @endif
                                        @if ($comment->user->image === null)
                                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                                        @else
                                        <img class="iconImage" src="{{ asset('storage/images/'.$comment->user->image) }}" alt="">
                                        @endif
                                </figure>
                                        <span class="block name">{{ $comment->user->name }}</span>
                                    </a>
                            </div>
                            <div class="body">
                                {!! nl2br($comment->body_link) !!}
                            </div>
                            <div class="textRight day">
                                {{ $comment->updated_at }}
                            </div>
                            <div class="flex">
                                @if ($comment->user_id === Auth::id())
                                    <a class="editGood" href="{{ route('edit', $tweet) }}">
                                        <i class="fa-solid fa-eraser"></i>
                                        <button class="btnNone">編集</button>
                                    </a>
                                @endif
                            </div>

                        </li>
                    </div>
                @endforeach
            @endif
        </div>

        <div>
            <a href="{{ route('index') }}">戻る</a>
        </div>
    </div>

</x-layout>
