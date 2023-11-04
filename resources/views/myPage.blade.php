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
            <div class="rightLink headerMenu">
                <div class="profNavi">
                    <a href="{{ route('profileEditPage', $user) }}">編集</a>
                    <ul class="dropdown_lists">
                        <li class="dropdown_list"><a href="{{ route('profileEditPage', $user) }}">プロフィール編集</a></li>
                        <li class="dropdown_list"><a href="{{ route('passwordEditPage', $user) }}">パスワード変更</a></li>
                        <li class="dropdown_list"><a href="{{ route('emailEditPage', $user) }}">メールアドレス変更</a></li>
                    </ul>
                </div>
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
            <li>
                <div>
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
                        <span class="editGood">
                            <i class="fa-solid fa-heart fa-lg" style="color: #963649;"></i> {{ $myTweet->likes_count }}
                            <a href="{{ route('edit', $myTweet) }}">編集</a>
                        </span>
                    </div>
                </div>
            </li>
        </div>
        @endforeach
    </div>

</x-layout>

