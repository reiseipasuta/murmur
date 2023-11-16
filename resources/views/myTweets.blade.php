<x-layout>
    <x-slot name="title">
        MyPage - MurMur
    </x-slot>

    <div class="contents">
        @foreach ($myTweets as $myTweet)
            <li>
                {{ $myTweet->body }}
                <a href="{{ route('edit', $myTweet) }}">編集</a>
            </li>
        @endforeach
    </div>

</x-layout>
