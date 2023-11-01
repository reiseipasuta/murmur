<x-layout>
    <x-slot name="title">
        UserPage（{{$user->name}}）
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
            @if ($follower)
            <form class="rightLink" action="{{ route('followDestroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="followingBtn">フォロー中</button>
                {{-- <input type="submit" value="フォロー中"> --}}
            </form>
            @else
            <form class="rightLink" action="{{ route('followStore', $user) }}" method="POST">
                @csrf
                <button class="followBtn">フォローする</button>
            </form>
            @endif
        </div>
        <div class="profileSentence">
            @if ($user->profile != null)
                {{ $user->profile }}
            @else
                <span>自己紹介未入力</span>
            @endif
        </div>
        <div class="profileFollows">
            フォロー数：{{ $user->followings_count }}
            フォロワー数：{{ $user->followers_count }}
        </div>

        @foreach ($userTweets as $userTweet)
        <div class="post">
            <li>
                <div class="body">
                    {{ $userTweet->body }}
                </div>
                <div class="textCenter">
                    @if ($userTweet->image === null)

                    @elseif ($userTweet->getImageOrVideo($userTweet->image) == 'image')
                    <img class="tweetImage" src="{{ asset('storage/tweetImages/'.$userTweet->image) }}" alt="">
                    @elseif ($userTweet->getImageOrVideo($userTweet->image) == 'video')
                    <video class="tweetImage" controls controlsList="nodownload" src="{{ asset('storage/tweetImages/'.$userTweet->image.'#t=0.001') }}" muted class="contents_width"></video>
                    @endif
                </div>
                <div class="textRight day">
                    {{ $userTweet->updated_at }}
                </div>
                <div class="flex">
                    <a href="{{ route('createComment', $userTweet) }}">コメント {{ $userTweet->comments_count }}</a>
                    <form action="{{ route('likeChange', $userTweet, ) }}" method="post" class="editGood">
                        @csrf
                        @if($userTweet->isLike(Auth::id()))
                        {{-- <button>❤︎</button> --}}
                        <button type="submit" class="btnNone">
                            <i class="fa-solid fa-heart fa-lg" style="color: #963649;"></i>
                        </button>
                        {{ $userTweet->likes_count }}
                        @else
                        <button type="submit" class="btnNone">
                            <i class="fa-regular fa-heart fa-lg" style="color: #963649;"></i>
                        </button>
                        {{ $userTweet->likes_count }}
                        @endif
                    </form>
                </div>
                {{-- {!! nl2br(e($tweet->body)) !!} --}}
                {{-- @php dd($tweet) @endphp --}}
            </li>
        </div>
        @endforeach
    </div>

</x-layout>
