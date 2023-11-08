<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="listTitle">
            <i class="fa-solid fa-heart-circle-plus fa-2xl rightMar5" style="color: #743e41;"></i>{{ $title }}リスト
        </div>
        @if($follows == '[]')
            <p>
                登録しているユーザーはいません。
            </p>
        @else
            @foreach ($follows as $follow)
            <div class="post">
            <div class="profileIcon">
                <figure class="iconCircle">
                    @if ($follow->image === null)
                    <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                    @else
                    <img class="iconImage" src="{{ asset('storage/images/'.$follow->image) }}" alt="">
                    @endif
                </figure>
                <p class="name">{{ $follow->name }}</p>
                <div class="rightLink followListFlex">
                    @if ($title == 'フォロー')
                    <form action="{{ route('followDestroy', $follow) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="followingListBtn">フォロー解除</button>
                    </form>
                    @endif
                    {{-- <div class="followListProf">
                        {{ Str::limit($follow->profile, 150, '...') }}
                    </div> --}}
                </div>
            </div>
            <div class="followListProf">
                {{ Str::limit($follow->profile, 150, '...') }}
            </div>
            </div>

                {{-- <div class="post">
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
                    <div class="">
                        <div>
                            フォロー解除
                        </div>
                        <p>
                            {{ Str::limit($follow->profile, 40, '...') }}
                        </p>
                    </div>
                    </div>
                </div> --}}
            @endforeach
        @endif
    </div>

</x-layout>

