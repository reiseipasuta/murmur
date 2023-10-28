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
                <img class="iconImage" src="{{ Storage::url($user->image) }}" alt="">
                @endif
            </figure>
            <p class="name">{{ $user->name }}</p>
            <div class="rightLink headerMenu">
                <a href="{{ route('profileEditPage', $user) }}">プロフィール編集</a>
                <a href="{{ route('passwordEditPage', $user) }}">パスワード変更</a>
                <a href="{{ route('emailEditPage', $user) }}">メールアドレス変更</a>
            </div>
        </div>
        <div class="profileSentence">
            {{ $user->profile }}
        </div>
        <div class="profileFollows">
            <a href="{{ route('followingList', $user) }}">フォロー：{{ $user->followings_count }}</a>
            <a href="{{ route('followerList', $user) }}">フォロワー：{{ $user->followers_count }}</a>
            <a href="{{ route('goodList', $user) }}">いいねリスト</a>
        </div>

        @foreach ($myTweets as $myTweet)
        <div class="post">
            <li>
                <div>
                    <div class="body">
                        {{ $myTweet->body }}
                    </div>
                    <div class="textRight day">
                        {{ $myTweet->updated_at }}
                    </div>
                    <div class="flex">
                        <a href="{{ route('createComment', $myTweet) }}">コメント {{ $myTweet->comments_count }}</a>
                        <span class="editGood">♡ {{ $myTweet->likes_count }}
                        <a href="{{ route('edit', $myTweet) }}">編集</a></span>
                    </div>
                </div>
            </li>
        </div>
        @endforeach
    </div>

</x-layout>

