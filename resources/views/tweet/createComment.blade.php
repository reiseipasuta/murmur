<x-layout>
    <x-slot name="title">
        createComment
    </x-slot>
{{-- <?php
dd($comments);
?> --}}
    <div class="contents">
        <div class="post">
            <div class="flex">
                @if ($tweet->user_id === Auth::id())
                <a href="{{ route('myPage') }}">
                @else
                <a href="{{ route('userPage', $tweet->user) }}">
                @endif
                    <div class="profileIcon">
                        <figure class="iconCircleSmall">
                            @if ($tweet->user->image === null)
                            <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                            @else
                            <img class="iconImage" src="{{ asset('storage/images/'.$tweet->user->image) }}" alt="">
                            @endif
                        </figure>
                        <span class="name">{{ $tweet->user->name }}</span>
                    </div>
                </a>
                @if ($tweet->user_id === Auth::id())
                <div class="editGood editMenu">
                    <label>
                        <input type="checkbox" class="hidden">
                        <div class="modal-overlay"></div>
                        <i class="fa-solid fa-ellipsis fa-lg" style="cursor: pointer;"></i>
                        <ul class="edit_dropdown_lists">
                            <a href="{{ route('edit', $tweet) }}">
                                <li class="dropdown_list">
                                    <i class="fa-solid fa-eraser"></i>
                                    <button class="btnNone">編集</button>
                                </li>
                            </a>
                            <li class="dropdown_list">
                                <form action="{{ route('destroy', $tweet) }}" method="post" class="delete">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btnNone"><i class="fa-solid fa-trash rightMar5"></i>削除</button>
                                </form>
                            </li>
                            {{-- <li class="dropdown_list_close">
                                <label>
                                </label>
                                <span>閉じる</span>
                            </li> --}}
                        </ul>
                    </label>
                </div>
                @endif
            </div>
            <div class="body">
                    {!! nl2br($tweet->body_link) !!}
                </div>
                <div class="textRight day">
                    {{ $tweet->updated_at }}
                </div>
                <div class="flex">
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
                </div>
        </div>

        <p>コメント一覧</p>
        <div class="comment">
            {{-- コメントフォーム --}}
            <div class="flex width100 justCenter">
                <div class="commentForm">
                    <details>
                        <summary class="textCenter">
                            <i class="fa-solid fa-comment fa-flip-horizontal fa-xl rightMar5" style="color: #ccc0af;"></i>コメント新規投稿
                        </summary>
                        <div class="openForm">
                            <form method="POST" action="{{ route('storeComment', $tweet) }}">
                                @csrf
                                <textarea name="body" id="commentText" onkeyup="ShowLength(value);" required maxlength="200">{{ old('body') }}</textarea>
                                <p class="length">
                                    <span id="inputlength">0</span><span>/200文字</span>
                                </p>
                                <input type="hidden" name="id" value="{{ $tweet->id }}">
                                @error('body')
                                <div>{{ $message }}</div>
                                @enderror
                                <button class="postBtn">投稿</button>
                            </form>
                        </div>
                    </details>
                </div>
            </div>
            {{-- コメントフォームここまで --}}
            @if ($comments == "[]")
                <div class="commentPost">
                    <p>まだコメントはありません。</p>
                </div>
            @else
                @foreach ($comments as $comment)
                <div class="post">
                    <div class="flex">
                        @if ($comment->user_id === Auth::id())
                        <a href="{{ route('myPage') }}">
                        @else
                        <a href="{{ route('userPage', $comment->user) }}">
                        @endif
                            <div class="profileIcon">
                                <figure class="iconCircleSmall">
                                    @if ($comment->user->image === null)
                                    <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                                    @else
                                    <img class="iconImage" src="{{ asset('storage/images/'.$comment->user->image) }}" alt="">
                                    @endif
                                </figure>
                                <span class="name">{{ $comment->user->name }}</span>
                            </div>
                        </a>
                        @if ($comment->user_id === Auth::id())
                        <div class="editGood editMenu ">
                            <label>
                                <input type="checkbox" class="hidden">
                                <div class="modal-overlay"></div>
                                <i class="fa-solid fa-ellipsis fa-lg" style="cursor: pointer;"></i>
                                <ul class="edit_dropdown_lists">
                                    <a href="{{ route('editComment', ['tweet' => $tweet, 'comment' => $comment]) }}">
                                        <li class="dropdown_list">
                                            <i class="fa-solid fa-eraser"></i>
                                            <button class="btnNone">編集</button>
                                        </li>
                                    </a>
                                    <li class="dropdown_list">
                                        <form action="{{ route('destroyComment', ['tweet' => $tweet, 'comment' => $comment]) }}" method="post" class="delete">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btnNone"><i class="fa-solid fa-trash rightMar5"></i>削除</button>
                                        </form>
                                    </li>
                                    {{-- <li class="dropdown_list_close">
                                        <label>
                                        </label>
                                        <span>閉じる</span>
                                    </li> --}}
                                </ul>
                            </label>
                        </div>
                        @endif
                    </div>

                    <div class="body">
                        {!! nl2br($comment->body_link) !!}
                    </div>
                    {{-- <div class="textCenter">
                        @if ($tweet->image === null)

                        @elseif ($tweet->getImageOrVideo($tweet->image) == 'image')
                        <img class="tweetImage" src="{{ asset('storage/tweetImages/'.$tweet->image) }}" alt="">
                        @elseif ($tweet->getImageOrVideo($tweet->image) == 'video')
                        <video class="tweetImage" controls controlsList="nodownload" oncontextmenu="return false;" src="{{ asset('storage/tweetImages/'.$tweet->image.'#t=0.001') }}" muted class="contents_width"></video>
                        @endif
                    </div> --}}
                    <div class="textRight day">
                        {{ $comment->updated_at->format('Y-m-d H:i') }}
                    </div>

                </div>
                @endforeach
             @endif
        </div>
    </div>

</x-layout>
