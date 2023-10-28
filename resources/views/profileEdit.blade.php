<x-layout>
    <x-slot name="title">
        MyPage
    </x-slot>

    <div class="contents">
        <div class="profileEditTitle">プロフィール編集</div>
        <form method="post" action="{{ route('profileEdit', $user) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div>
                <div class="flex profileEditContent">
                    <div class="iconCircle">
                        @if ($user->image === null)
                        <img class="iconImage" src="{{ asset('storage/images/default.png') }}" alt="">
                        @else
                        <img class="iconImage" src="{{ Storage::url($user->image) }}" alt="">
                        @endif
                    </div>
                    <div class="profileEditContent">
                        <input name="image" type="file" value="" accept="image/png, image/jpeg">
                    </div>
                </div>
                <div class="profileEditContent">
                    <div class="flex">
                        <div class="square"></div>
                        名前
                    </div>
                    <input type="text" name="name" value="{{ $user->name }}">
                </div>
                <div class="profileEditContent">
                    <div class="flex"><div class="square"></div>紹介文</div>
                    <textarea name="profile" id="" cols="30" rows="10">{{ $user->profile }}</textarea>
                </div>
                <button>編集</button>
            </div>
        </form>
    </div>

</x-layout>
