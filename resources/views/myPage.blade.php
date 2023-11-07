<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="profileIcon">
            <figure class="iconCircle">
                @if ($user->image === null)
                <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                @else
                <img class="iconImage" src="{{ asset('storage/images/'.$user->image) }}" alt="">
                @endif
            </figure>
            <p class="name">{{ $user->name }}</p>
            <div class="rightLink profNavi" ontouchstart="">
                {{-- <div class="profNavi"> --}}
                    <label>
                        <input type="checkbox" class="hidden">
                        <div class="modal-overlay"></div>
                        <span>Menu</span>
                        <ul class="dropdown_lists">
                            <a href="{{ route('profileEditPage', $user) }}">
                                <li class="dropdown_list">
                                    プロフィール編集
                                </li>
                            </a>
                            <a href="{{ route('passwordEditPage', $user) }}">
                                <li class="dropdown_list">
                                    パスワード変更
                                </li>
                            </a>
                            <a href="{{ route('emailEditPage', $user) }}">
                                <li class="dropdown_list">
                                    メールアドレス変更
                                </li>
                            </a>
                        </ul>
                    </label>

                {{-- </div> --}}
            </div>
        </div>
        <div class="profileSentence">
            @if ($user->profile != null)
                {{ $user->profile }}
            @else
                <span>自己紹介未入力</span>
            @endif
        </div>
        <div class="profileFollows">
            <a class="inlineBlock mypageListLink" href="{{ route('followingList', $user) }}">{{ $user->followings_count }} フォロー中</a>
            <a class="inlineBlock mypageListLink" href="{{ route('followerList', $user) }}">{{ $user->followers_count }} フォロワー</a>
            <span class="inlineBlock mypageListLink">
                <i class="fa-solid fa-heart fa-lg" style="color: #963649;"></i>
                <a href="{{ route('goodList', $user) }}">いいねリスト</a>
            </span>
        </div>

        @foreach ($myTweets as $myTweet)
        <div class="post">
            <div class="flex">
                @if ($myTweet->user_id === Auth::id())
                <a href="{{ route('myPage') }}">
                @else
                <a href="{{ route('userPage', $myTweet->user) }}">
                @endif
                    <div class="profileIcon">
                        <figure class="iconCircleSmall">
                            @if ($myTweet->user->image === null)
                            <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                            @else
                            <img class="iconImage" src="{{ asset('storage/images/'.$myTweet->user->image) }}" alt="">
                            @endif
                        </figure>
                        <span class="name">{{ $myTweet->user->name }}</span>
                    </div>
                </a>
                @if ($myTweet->user_id === Auth::id())
                <div class="editGood editMenu">
                    <label>
                        <input type="checkbox" class="hidden">
                        <div class="modal-overlay"></div>
                        <i class="fa-solid fa-ellipsis fa-lg" style="cursor: pointer;"></i>
                        <ul class="edit_dropdown_lists">
                            <a href="{{ route('edit', $myTweet) }}">
                                <li class="dropdown_list">
                                    <i class="fa-solid fa-eraser"></i>
                                    <button class="btnNone">編集</button>
                                </li>
                            </a>
                            <li class="dropdown_list">
                                <form action="{{ route('destroy', $myTweet) }}" method="post" class="delete">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btnNone"><i class="fa-solid fa-trash rightMar5"></i>削除</button>
                                </form>
                            </li>
                        </ul>
                    </label>
                </div>
                @endif
            </div>


                    <div class="body">
                        {{ $myTweet->body }}
                    </div>
                    <div class="textCenter">
                        @if ($myTweet->image === null)

                        @elseif ($myTweet->getImageOrVideo($myTweet->image) == 'image')
                        <img class="tweetImage" src="{{ asset('storage/tweetImages/'.$myTweet->image) }}" alt="">
                        @elseif ($myTweet->getImageOrVideo($myTweet->image) == 'video')
                        <video class="tweetImage" controls controlsList="nodownload" src="{{ asset('storage/tweetImages/'.$myTweet->image.'#t=0.001') }}" muted class="contents_width"></video>
                        @endif
                    </div>
                    <div class="textRight day">
                        {{ $myTweet->updated_at }}
                    </div>
                    <div class="flex">
                        <a href="{{ route('createComment', $myTweet) }}">
                            @if ($myTweet->comments_count == false)
                                <i class="fa-regular fa-comment fa-lg" style="color: #465a7c;"></i>
                            @else
                                <i class="fa-solid fa-comments fa-lg"></i>
                            @endif
                            コメント {{ $myTweet->comments_count }}
                        </a>
                        <form action="{{ route('likeChange', $myTweet, ) }}" method="post" class="editGood">
                            @csrf
                            @if($myTweet->isLike(Auth::id()))
                            <button type="submit" class="btnNone">
                                <i class="fa-solid fa-heart fa-lg" style="color: #963649;"></i>
                            </button>
                            {{ $myTweet->likes_count }}
                            @else
                            <button type="submit" class="btnNone">
                                <i class="fa-regular fa-heart fa-lg" style="color: #963649;"></i>
                            </button>
                            {{ $myTweet->likes_count }}
                            @endif
                        </form>
                    </div>

        </div>
        @endforeach
    </div>

</x-layout>

