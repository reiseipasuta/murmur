<x-layout>
    <x-slot name="title">
        Tweeeeeter
    </x-slot>

        <div class="contents">
            @foreach ($tweets as $tweet)
            {{-- <a href="{{ route('createComment', $tweet) }}"> --}}
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
                                <li class="dropdown_list_close">
                                    <label>
                                    </label>
                                    <span>閉じる</span>
                                </li>
                            </ul>
                        </label>
                    </div>
                    @endif
                </div>

                <div class="body">
                    {!! nl2br($tweet->body_link) !!}
                </div>
                <div class="textCenter">
                    @if ($tweet->image === null)

                    @elseif ($tweet->getImageOrVideo($tweet->image) == 'image')
                    <img class="tweetImage" src="{{ asset('storage/tweetImages/'.$tweet->image) }}" alt="">
                    @elseif ($tweet->getImageOrVideo($tweet->image) == 'video')
                    <video class="tweetImage" controls controlsList="nodownload" src="{{ asset('storage/tweetImages/'.$tweet->image.'#t=0.001') }}" muted class="contents_width"></video>
                    @endif
                </div>
                <div class="textRight day">
                    {{ $tweet->updated_at->format('Y-m-d H:i') }}
                </div>
                <div class="flex">
                    <a href="{{ route('createComment', $tweet) }}">
                        @if ($tweet->comments_count == false)
                            <i class="fa-regular fa-comment fa-lg" style="color: #465a7c;"></i>
                        @else
                            <i class="fa-solid fa-comments fa-lg"></i>
                        @endif
                        コメント {{ $tweet->comments_count }}
                    </a>
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
        </a>
            @endforeach
                {{ $tweets->links('vendor.pagination.original') }}
        </div>

            <!-- モーダルウィンドウ -->

        {{-- <div id="edit-modal-content">
            <div class="contents newPostIpad">
                <div class="title">
                    <i class="fa-solid fa-pen-nib rightMar5" style="color: #424f67;"></i>編集
                </div>

                <form method="POST" action="{{ route('update', $tweet) }}" id="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <textarea name="body" id="text" onkeyup="ShowLength(value);" required maxlength="200">{{ $tweet->body }}</textarea>
                    <p class="length">
                        <span id="inputlength">0</span><span>/200文字</span>
                    </p>
                    @error('body')
                        <div>{{ $message }}</div>
                    @enderror
                    <input type="file" name="image" accept="image/*, video/*">
                    <button>投稿</button>
                </form>
                <form action="{{ route('destroy', $tweet) }}" method="post" id="delete">
                    @method('DELETE')
                    @csrf
                    <button>削除</button>
                </form>
            </div>
            <div class="close">
                    <a id="modal-close" onclick="edit_modal_onclick_close()">
                    <i class="fa-solid fa-xmark rightMar5"></i>
                    閉じる
                </a>
                </div>
        </div>
        <!-- 2番目に表示されるモーダル -->
        <div id="edit-modal-overlay" onclick="edit_modal_onclick_close()"></div>

        <!-- モーダルウィンドウここまで --> --}}




</x-layout>

