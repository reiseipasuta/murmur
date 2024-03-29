<x-layout>
    <x-slot name="title">
        MyPage - MurMur
    </x-slot>

    <div class="contents">
        <div class="profileEditTitle"><div class="square"></div>プロフィール編集</div>
        <form method="post" action="{{ route('profileEdit', $user) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div>
                <div class="profileEditContent flexProfileIcon">
                    <div class="iconCircle">
                        @if ($user->image === null)
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                        @else
                        <img class="iconImage" src="{{ asset('storage/images/'.$user->image) }}" alt="">
                        @endif
                    </div>
                    <input name="image" type="file" value="" accept="image/png, image/jpeg">
                </div>
                <div class="profileEditContent">
                    <div class="flex">
                        <div class="square"></div>
                        名前
                    </div>
                    @if (Auth::id() === 6)
                    <input type="text" value="{{ $user->name }}" disabled>
                    <input type="hidden" name="name" value="{{ $user->name }}">
                    @else
                    <input type="text" name="name" value="{{ $user->name }}">
                    @endif
                </div>
                <div class="profileEditContent">
                    <div class="flex"><div class="square"></div>紹介文</div>
                    <textarea name="profile" id="" cols="30" rows="10">{{ $user->profile }}</textarea>
                </div>
                <button class="postBtn">編集</button>
            </div>
        </form>
    </div>

</x-layout>
