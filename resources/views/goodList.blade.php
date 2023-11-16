<x-layout>
    <x-slot name="title">
        いいねリスト - MurMur
    </x-slot>

    <div class="contents">
        <div class="listTitle">
            <i class="fa-solid fa-heart-circle-plus fa-2xl rightMar5" style="color: #743e41;"></i>いいねリスト
        </div>
        @if($tweets == '[]')
            <p>登録しているポストはありません。</p>
        @else
        <div class="search textRight">
            <form class="mobile" action="{{ route('index') }}" method="get">
                @csrf
                <input type="text" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif" placeholder="検索">
                <button class="mobileNone searchBtn">検索</button>
                {{-- {{ $errors }} --}}
            </form>
        </div>
        @foreach ($tweets as $tweet)
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
            <div class="textCenter">
                @if ($tweet->image === null)

                @elseif ($tweet->getImageOrVideo($tweet->image) == 'image')
                <img class="tweetImage" src="{{ asset('storage/tweetImages/'.$tweet->image) }}" alt="">
                @elseif ($tweet->getImageOrVideo($tweet->image) == 'video')
                <video class="tweetImage" controls controlsList="nodownload" oncontextmenu="return false;" src="{{ asset('storage/tweetImages/'.$tweet->image.'#t=0.001') }}" muted class="contents_width"></video>
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
        @endforeach

        {{ $tweets->links('vendor.pagination.original') }}
        @endif
    </div>

</x-layout>
