<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="listTitle">
            <i class="fa-solid fa-heart-circle-plus fa-2xl rightMar5" style="color: #743e41;"></i>いいねリスト
        </div>
        @if($follows == '[]')
            <p>
                登録しているユーザーはいません。
            </p>
        @else
            @foreach ($follows as $follow)
                <div class="post">
                    <div class="profileIcon">
                    <figure class="iconCircleSmall">
                        <a href="{{ route('userPage', $follow) }}">
                            @if ($follow->image === null)
                            <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                            @else
                            <img class="iconImage" src="{{ asset('storage/images/'.$follow->image) }}" alt="">
                            @endif
                        </a>
                    </figure>
                    <p class="name">
                        <a href="{{ route('userPage', $follow) }}">
                            {{ $follow->name }}
                        </a>
                    </p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</x-layout>

