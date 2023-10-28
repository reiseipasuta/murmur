<x-layout>
    <x-slot name="title">
        Tweeeeeter
    </x-slot>

    {{-- <div class="header">tweeeeeeter</div>
    <div class="container">
        <div class="menu">
            <div><a href="{{ route('dashboard') }}">マイページ</a></div>
            <div><a href="{{ route('myTweets') }}">投稿一覧</a></div>
            <div><a href="{{ route('create') }}">新規投稿</a></div>
        </div> --}}

        <div class="contents">
            <div class="search_result">
                <div class="result_users">
                    <p class="number">全{{ $tweets->total() }}件</p>
            @foreach ($tweets as $tweet)
            <div class="post">
                <div class="profileIcon">
                @if ($tweet->user_id === Auth::id())
                    <figure class="iconCircleSmall">
                        <a href="{{ route('myPage') }}">
                            @if ($tweet->user->image === null)
                            <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                            @else
                            <img class="iconImage" src="{{ Storage::url($tweet->user->image) }}" alt="">
                            @endif
                        </a>
                    </figure>
                    <p class="name">
                        <a href="{{ route('myPage') }}">
                            {{ $tweet->user->name }}
                        </a>
                    </p>
                @else
                <figure class="iconCircleSmall">
                    <a href="{{ route('userPage', $tweet->user) }}">
                        @if ($tweet->user->image === null)
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                        @else
                        <img class="iconImage" src="{{ Storage::url($tweet->user->image) }}" alt="">
                        @endif
                    </a>
                </figure>
                <p class="name">
                    <a href="{{ route('userPage', $tweet->user) }}">
                        {{ $tweet->user->name }}
                    </a>
                </p>
                @endif
                </div>
                    <div class="body">
                        {{ $tweet->body }}
                    </div>
                    <div class="flex">
                        <a href="{{ route('createComment', $tweet) }}">コメント {{ $tweet->comments_count }}</a>
                        @if ($tweet->user_id === Auth::id())
                            <a class="editTweet" href="{{ route('edit', $tweet) }}">編集</a>
                        @endif
                    </div>
                    {{-- {!! nl2br(e($tweet->body)) !!} --}}
                    {{-- @php dd($tweet) @endphp --}}
            </div>
            @endforeach
        </div>
    </div>
        </div>

    {{-- </div> --}}


    <script src="/js/jquery.infinitescroll.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
        var pageCount = {{ $tweets->lastPage() }};
        var nowPage = 1;
        $('.result_tweets').infinitescroll({
            navSelector  : ".more",
            nextSelector : ".more a",
            itemSelector : ".info",
            loading : {
                img : '',
                msgText : 'Now loading....',
                finishedMsg : '',
            },
        },
        function(newElements) {
            var $newElems = $(newElements);
            $("#infscr-loading").remove();
            if (nowPage < pageCount) {
                $(".more").appendTo(".result_tweets");
                $(".more").css({display: 'block'});
            }
            nowPage++;
        });

        // クリックでスクロールさせるためinfinitescrollをunbind
        // $('.result_users').infinitescroll('unbind');
        // // クリック時の動作
        // $('.more a').click(function(){
        //     $('.result_users').infinitescroll('retrieve');
        //     return false;
        // });
    </script>

</x-layout>

