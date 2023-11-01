<x-layout>
    <x-slot name="title">
        いいねリスト
    </x-slot>

    <div class="contents">
        <div class="listTitle">
            <i class="fa-solid fa-heart-circle-plus fa-2xl rightMar5" style="color: #743e41;"></i>いいねリスト
        </div>
        @if($goodTweets == '[]')
            <p>登録しているポストはありません。</p>
        @else
            @foreach ($goodTweets as $tweet)
            <div class="post">
                <div class="profileIcon">
                    @if ($tweet->user_id === Auth::id())
                    <a href="{{ route('myPage') }}">
                    @else
                    <a href="{{ route('userPage', $tweet->user) }}">
                    @endif
                        <figure class="iconCircleSmall">
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
                    {{ $tweet->body }}
                </div>
                <div class="flex">
                    <a href="{{ route('createComment', $tweet) }}">コメント {{ $tweet->comments_count }}</a>
                    @if ($tweet->user_id === Auth::id())
                        <a class="editTweet" href="{{ route('edit', $tweet) }}">編集</a>
                    @else
                        <form action="{{ route('likeChange', $tweet, ) }}" method="post">
                            @csrf
                            @if($tweet->isLike(Auth::id()))
                            <button class="editTweet">いいねを外す</button>
                            @else
                            <button class="editTweet">いいねする</button>
                            @endif
                        </form>
                    @endif
                </div>
                    {{-- {!! nl2br(e($tweet->body)) !!} --}}
                    {{-- @php dd($tweet) @endphp --}}
            </div>
            @endforeach
        @endif
    </div>

</x-layout>
